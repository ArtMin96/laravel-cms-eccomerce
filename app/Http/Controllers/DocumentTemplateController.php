<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Contracts\OrderContract;
use App\DocumentLanguages;
use App\Order;
use App\OrderItem;
use App\Page;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use PhpOffice\PhpWord\PhpWord;
use Session;

class DocumentTemplateController extends Controller
{

    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index() {
        $page = Page::where('page_number', '=', Page::DocumentTemplates)->first();

        $productQuery = Product::where('sale_type_id', Product::DocumentTemplate);

        if (request()->catalog) {
            $productQuery->whereHas('catalog', function ($query) {
                $query->where('id', request()->catalog);
            });
        }

        if (request()->language) {
            $productQuery->whereHas('documentLanguage', function ($query) {
                $query->where('id', request()->language);
            });
        }

        $products = $productQuery->orderBy('id', 'DESC')->paginate(8);

        $catalog = Catalog::all();
        $languages = DocumentLanguages::all();
        return view('document-template.index', compact('page', 'products', 'catalog', 'languages'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function getSearch(Request $request)
    {
        $searchTerm = $request->get('q');

        if (empty($searchTerm)) {
            $productQuery = Product::where('sale_type_id', Product::DocumentTemplate);
        } else {
            $productQuery = Product::whereLike(['productTranslations.title'], $searchTerm)->where('sale_type_id', Product::DocumentTemplate);
        }

        if (request()->catalog) {
            $productQuery->whereHas('catalog', function ($query) {
                $query->where('id', request()->catalog);
            });
        }

        if (request()->language) {
            $productQuery->whereHas('documentLanguage', function ($query) {
                $query->where('id', request()->language);
            });
        }

        $products = $productQuery->orderBy('id', 'DESC')->paginate(8);

        $page = Page::where('page_number', '=', Page::DocumentTemplates)->first();
        $catalog = Catalog::all();
        $languages = DocumentLanguages::all();

        //return display search result to user by using a view
        return view('document-template.index', compact('products', 'page', 'searchTerm', 'catalog', 'languages'));
    }

    /**
     * @param Request $request
     * @param $id
     * @param $language
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function download(Request $request, $id, $language)
    {

        if ($id == 1 || $id == 2) {
            return $this->downloadPassport($request, $id);
        }

        if ($id == 3 || $id == 4) {
            return $this->downloadBirthCertificate($request, $id);
        }

        if ($id == 5 || $id == 6) {
            return $this->downloadDeathCertificate($request, $id);
        }

        if ($id == 7 || $id == 8) {
            return $this->downloadMarriageCertificate($request, $id);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function downloadPassport(Request $request, $id)
    {

        if ($id == 1) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(asset('document-templates/passport_of_RA_eng.docx'));
            $templateProcessor->setValue('date_of_birth', $this->toDate($request->input('date_of_birth')));
            $templateProcessor->setValue('issued_date', $this->toDate($request->input('issued_date')));
            $templateProcessor->setValue('valid_until', $this->toDate($request->input('valid_until')));
            $templateProcessor->setValue('valid_foreign_countries_date', $this->toDate($request->input('valid_foreign_countries_date')));
        }

        if ($id == 2) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(asset('document-templates/passport_of_RA_rus.docx'));
            $templateProcessor->setValue('date_of_birth', $this->toDate($request->input('date_of_birth'), 'ru'));
            $templateProcessor->setValue('issued_date', $this->toDate($request->input('issued_date'), 'ru'));
            $templateProcessor->setValue('valid_until', $this->toDate($request->input('valid_until'), 'ru'));
            $templateProcessor->setValue('valid_foreign_countries_date', $this->toDate($request->input('valid_foreign_countries_date'), 'ru'));
        }

        $fileName = 'Passport-' . time() . '.docx';

        $templateProcessor->setValue('type', $request->input('type'));
        $templateProcessor->setValue('country_code', $request->input('country_code'));
        $templateProcessor->setValue('series_number', $request->input('series_number'));
        $templateProcessor->setValue('surname', $request->input('surname'));
        $templateProcessor->setValue('name', $request->input('name'));
        $templateProcessor->setValue('middle_name', $request->input('middle_name'));
        $templateProcessor->setValue('nationality', $request->input('nationality'));
        $templateProcessor->setValue('place_of_birth', $request->input('place_of_birth'));
        $templateProcessor->setValue('sex', $request->input('sex'));
        $templateProcessor->setValue('issued_by', $request->input('issued_by'));
        $templateProcessor->setValue('registration_place', $request->input('registration_place'));
        $templateProcessor->setValue('authority', $request->input('authority'));

        $destinationPath = '';
        $imageName = '';

        if ($request->hasFile('passport_image')) {
            $image = $request->file('passport_image');
            $imageName = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/document-templates/generated');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$imageName, 90);

            $templateProcessor->setImageValue('PassportImage', ['path' => $destinationPath.'/'.$imageName, 'width' => 100, 'height' => 100, 'ratio' => false]);
        }

        $templateProcessor->setValue('registration_date', date('d.m.Y', strtotime($request->input('registration_date'))));

        $templateProcessor->saveAs($fileName);

        if (file_exists($destinationPath.'/'.$imageName)) {
            unlink($destinationPath.'/'.$imageName);
        }

        $order = Order::create([
            'order_number'      =>  strtoupper(bin2hex(random_bytes(3))),
            'user_id'           =>  auth()->user()->id,
            'status'            =>  1,
            'grand_total'       =>  0,
            'item_count'        =>  0,
            'payment_status'    =>  0,
            'payment_method'    =>  0,
            'sale_type_id'      =>  Order::TRANSLATE_YOURSELF,
            'first_name'        =>  auth()->user()->name,
            'last_name'         =>  auth()->user()->last_name,
            'address'           =>  auth()->user()->address ?: null,
            'phone_number'      =>  auth()->user()->phone,
            'is_delivery'       =>  0,
        ]);

        if ($order) {
            $product = Product::where('id', $id)->first();

            $orderItem = new OrderItem([
                'order_id'      =>  $order->id,
                'product_id'    =>  $product->id,
                'quantity'      =>  1,
                'price'         =>  0
            ]);

            $order->items()->save($orderItem);
        }

        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function downloadBirthCertificate(Request $request, $id)
    {

        $fileName = 'BirthCertificate-' . time() . '.docx';

        if ($id == 3) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(asset('document-templates/birth_certificate_rus.docx'));
            $templateProcessor->setValue('book_register', $request->input('book_register'));
            $templateProcessor->setValue('recorded', $request->input('recorded'));
            $templateProcessor->setValue('registration_place', $request->input('registration_place'));
            $templateProcessor->setValue('issued_date', $this->toDate($request->input('issued_date')));
            $templateProcessor->setValue('territorial_department', $request->input('territorial_department'));
            $templateProcessor->setValue('document_number', $request->input('document_number'));
            $templateProcessor->setValue('date_of_birth', $this->toDate($request->input('date_of_birth')));
        }

        if ($id == 4) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(asset('document-templates/birth_state_certificate_eng.docx'));
            $templateProcessor->setValue('date_of_entry', $this->toDate($request->input('date_of_entry'), 'ru'));
            $templateProcessor->setValue('registration_number', $request->input('registration_number'));
            $templateProcessor->setValue('registration_body', $request->input('registration_body'));
            $templateProcessor->setValue('date', $this->toDate($request->input('date'), 'ru'));
            $templateProcessor->setValue('date_of_birth', $this->toDate($request->input('date_of_birth'), 'ru'));
        }

        $templateProcessor->setValue('surname', $request->input('surname'));
        $templateProcessor->setValue('name', $request->input('name'));
        $templateProcessor->setValue('middle_name', $request->input('middle_name'));
        $templateProcessor->setValue('nationality', $request->input('nationality'));
        $templateProcessor->setValue('place_of_birth', $request->input('place_of_birth'));
        $templateProcessor->setValue('father_surname', $request->input('father_surname'));
        $templateProcessor->setValue('father_name', $request->input('father_name'));
        $templateProcessor->setValue('father_middle_name', $request->input('father_middle_name'));
        $templateProcessor->setValue('father_nationality', $request->input('father_nationality'));
        $templateProcessor->setValue('mother_surname', $request->input('mother_surname'));
        $templateProcessor->setValue('mother_name', $request->input('mother_name'));
        $templateProcessor->setValue('mother_middle_name', $request->input('mother_middle_name'));
        $templateProcessor->setValue('mother_nationality', $request->input('mother_nationality'));

        $templateProcessor->saveAs($fileName);

        $order = Order::create([
            'order_number'      =>  strtoupper(bin2hex(random_bytes(3))),
            'user_id'           =>  auth()->user()->id,
            'status'            =>  1,
            'grand_total'       =>  0,
            'item_count'        =>  0,
            'payment_status'    =>  0,
            'payment_method'    =>  0,
            'sale_type_id'      =>  Order::TRANSLATE_YOURSELF,
            'first_name'        =>  auth()->user()->name,
            'last_name'         =>  auth()->user()->last_name,
            'address'           =>  auth()->user()->address ?: null,
            'phone_number'      =>  auth()->user()->phone,
            'is_delivery'       =>  0,
        ]);

        if ($order) {
            $product = Product::where('id', $id)->first();

            $orderItem = new OrderItem([
                'order_id'      =>  $order->id,
                'product_id'    =>  $product->id,
                'quantity'      =>  1,
                'price'         =>  0
            ]);

            $order->items()->save($orderItem);
        }

        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function downloadDeathCertificate(Request $request, $id)
    {

        $fileName = 'DeathCertificate-' . time() . '.docx';

        if ($id == 5) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(asset('document-templates/death_certificate_rus.docx'));
            $templateProcessor->setValue('date_of_death_text', $request->input('date_of_death_text'));
            $templateProcessor->setValue('book_register', $request->input('book_register'));
            $templateProcessor->setValue('produced_record', $request->input('produced_record'));
            $templateProcessor->setValue('cause_death', $request->input('cause_death'));
            $templateProcessor->setValue('death_place', $request->input('death_place'));
            $templateProcessor->setValue('death_registered', $request->input('death_registered'));
            $templateProcessor->setValue('issue_date', $this->toDate($request->input('issue_date')));
            $templateProcessor->setValue('document_number', $request->input('document_number'));
            $templateProcessor->setValue('date_of_birth', $this->toDate($request->input('date_of_birth')));
            $templateProcessor->setValue('date_of_death', $this->toDate($request->input('date_of_death')));
        }

        if ($id == 6) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(asset('document-templates/death_state_certificate_eng.docx'));
            $templateProcessor->setValue('date_of_entry', $this->toDate($request->input('date_of_entry'), 'ru'));
            $templateProcessor->setValue('registration_number', $request->input('registration_number'));
            $templateProcessor->setValue('registration_body', $request->input('registration_body'));
            $templateProcessor->setValue('date', $this->toDate($request->input('date'), 'ru'));
            $templateProcessor->setValue('citizenship', $request->input('citizenship'));
            $templateProcessor->setValue('place_of_birth', $request->input('place_of_birth'));
            $templateProcessor->setValue('date_of_birth', $this->toDate($request->input('date_of_birth'), 'ru'));
            $templateProcessor->setValue('date_of_death', $this->toDate($request->input('date_of_death'), 'ru'));
        }

        $templateProcessor->setValue('surname', $request->input('surname'));
        $templateProcessor->setValue('name', $request->input('name'));
        $templateProcessor->setValue('middle_name', $request->input('middle_name'));
        $templateProcessor->setValue('nationality', $request->input('nationality'));
        $templateProcessor->setValue('place_of_death', $request->input('place_of_death'));

        $templateProcessor->saveAs($fileName);

        $order = Order::create([
            'order_number'      =>  strtoupper(bin2hex(random_bytes(3))),
            'user_id'           =>  auth()->user()->id,
            'status'            =>  1,
            'grand_total'       =>  0,
            'item_count'        =>  0,
            'payment_status'    =>  0,
            'payment_method'    =>  0,
            'sale_type_id'      =>  Order::TRANSLATE_YOURSELF,
            'first_name'        =>  auth()->user()->name,
            'last_name'         =>  auth()->user()->last_name,
            'address'           =>  auth()->user()->address ?: null,
            'phone_number'      =>  auth()->user()->phone,
            'is_delivery'       =>  0,
        ]);

        if ($order) {
            $product = Product::where('id', $id)->first();

            $orderItem = new OrderItem([
                'order_id'      =>  $order->id,
                'product_id'    =>  $product->id,
                'quantity'      =>  1,
                'price'         =>  0
            ]);

            $order->items()->save($orderItem);
        }

        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function downloadMarriageCertificate(Request $request, $id)
    {

        $fileName = 'MarriageCertificate-' . time() . '.docx';

        if ($id == 7) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(asset('document-templates/marriage_certificate_eng.docx'));

            $templateProcessor->setValue('ca_surname', $request->input('ca_surname'));
            $templateProcessor->setValue('ca_name', $request->input('ca_name'));
            $templateProcessor->setValue('ca_middle_name', $request->input('ca_middle_name'));
            $templateProcessor->setValue('ca_birth_date', $this->toDate($request->input('ca_birth_date'), 'ru'));
            $templateProcessor->setValue('ca_birth_place', $request->input('ca_birth_place'));
            $templateProcessor->setValue('ca_nationality', $request->input('ca_nationality'));
            $templateProcessor->setValue('ch_surname', $request->input('ch_surname'));
            $templateProcessor->setValue('ch_name', $request->input('ch_name'));
            $templateProcessor->setValue('ch_middle_name', $request->input('ch_middle_name'));
            $templateProcessor->setValue('ch_birth_date', $this->toDate($request->input('ch_birth_date'), 'ru'));
            $templateProcessor->setValue('ch_birth_place', $request->input('ch_birth_place'));
            $templateProcessor->setValue('ch_nationality', $request->input('ch_nationality'));
        }

        if ($id == 8) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(asset('document-templates/marriage_certificate_rus.docx'));

            $templateProcessor->setValue('husband_surname', $request->input('husband_surname'));
            $templateProcessor->setValue('husband_name', $request->input('husband_name'));
            $templateProcessor->setValue('husband_middle_name', $request->input('husband_middle_name'));
            $templateProcessor->setValue('husband_birth_date', $this->toDate($request->input('husband_birth_date'), 'ru'));
            $templateProcessor->setValue('husband_birth_place', $request->input('husband_birth_place'));
            $templateProcessor->setValue('husband_nationality', $request->input('husband_nationality'));
            $templateProcessor->setValue('wife_surname', $request->input('wife_surname'));
            $templateProcessor->setValue('wife_name', $request->input('wife_name'));
            $templateProcessor->setValue('wife_middle_name', $request->input('wife_middle_name'));
            $templateProcessor->setValue('wife_birth_date', $this->toDate($request->input('wife_birth_date'), 'ru'));
            $templateProcessor->setValue('wife_birth_place', $request->input('wife_birth_place'));
            $templateProcessor->setValue('wife_nationality', $request->input('wife_nationality'));
            $templateProcessor->setValue('document_number', $request->input('document_number'));
        }

        $templateProcessor->setValue('produced_record', $request->input('produced_record'));
        $templateProcessor->setValue('book_register', $this->toDate($request->input('book_register'), 'ru'));
        $templateProcessor->setValue('book_register_husband', $request->input('book_register_husband'));
        $templateProcessor->setValue('book_register_wife', $request->input('book_register_wife'));
        $templateProcessor->setValue('registration_place', $request->input('registration_place'));
        $templateProcessor->setValue('issue_date', $this->toDate($request->input('issue_date'), 'ru'));

        $templateProcessor->saveAs($fileName);

        $order = Order::create([
            'order_number'      =>  strtoupper(bin2hex(random_bytes(3))),
            'user_id'           =>  auth()->user()->id,
            'status'            =>  1,
            'grand_total'       =>  0,
            'item_count'        =>  0,
            'payment_status'    =>  0,
            'payment_method'    =>  0,
            'sale_type_id'      =>  Order::TRANSLATE_YOURSELF,
            'first_name'        =>  auth()->user()->name,
            'last_name'         =>  auth()->user()->last_name,
            'address'           =>  auth()->user()->address ?: null,
            'phone_number'      =>  auth()->user()->phone,
            'is_delivery'       =>  0,
        ]);

        if ($order) {
            $product = Product::where('id', $id)->first();

            $orderItem = new OrderItem([
                'order_id'      =>  $order->id,
                'product_id'    =>  $product->id,
                'quantity'      =>  1,
                'price'         =>  0
            ]);

            $order->items()->save($orderItem);
        }

        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }

    /**
     * @param $date
     * @param string $locale
     * @return string
     */
    public function toDate($date, $locale = 'en')
    {
        return Carbon::parse($date)->locale($locale)->translatedFormat('d F Y');
    }

}
