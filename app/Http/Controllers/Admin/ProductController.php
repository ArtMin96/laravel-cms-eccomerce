<?php

namespace App\Http\Controllers\Admin;

use App\Catalog;
use App\DocumentLanguages;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductFiles;
use App\SaleType;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $products = Product::withTrashed()->where('sale_type_id', $id)->get();
        $saleType = SaleType::where('id', $id)->first();

        return view('admin.product.index', compact('products', 'saleType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $saleType = SaleType::where('id', $id)->first();
        $catalog = Catalog::all();
        $languages = DocumentLanguages::all();
        return view('admin.product.create', compact('id', 'saleType', 'catalog', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $rules = RuleFactory::make([
            '%title%' => 'required|string',
            '%description%' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        if ($request->input('sale_type_id') == 3) {
            $rules = RuleFactory::make([
                '%title%' => 'required|string',
                '%description%' => 'nullable|string',
                'price' => 'nullable|numeric',
                'file.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
            ]);
        }

        if ($request->input('sale_type_id') == 2) {
            $rules = RuleFactory::make([
                '%title%' => 'required|string',
                'file' => 'required|file|mimes:doc,pdf,docx|max:25000',
            ]);
        }

        if ($request->input('sale_type_id') == 1) {
            $rules = RuleFactory::make([
                '%title%' => 'required|string',
                '%description%' => 'nullable|string',
                'price' => 'required|numeric',
                'file.*' => 'required|mimes:pdf|max:25000',
                'preview_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
            ]);
        }

        $request->validate($rules);

        $product = new Product();
        $product->user_id = \Auth::check() ? \Auth::user()->id : null;
        $product->sale_type_id = $request->input('sale_type_id');
        $product->price = $request->input('price');
        $product->language = $request->input('language');
        $product->save();

        $product->catalog()->attach($request->input('catalog'));

        $translationProduct = Product::withTrashed()->findOrFail($product->id);
        $translationProduct->update([
            'en' => [
                'title' => $request->input('en')['title'],
                'description' => !empty($request->input('en')['description'])? $request->input('en')['description'] : null
            ],
            'ru' => [
                'title' => $request->input('ru')['title'],
                'description' => !empty($request->input('ru')['description'])? $request->input('ru')['description'] : null
            ],
            'hy' => [
                'title' => $request->input('hy')['title'],
                'description' => !empty($request->input('hy')['description'])? $request->input('hy')['description'] : null
            ]
        ]);

        // Upload files
        $createFile = ProductFiles::createFile($product->id, $request);

        if ($request->input('sale_type_id') == 3) {
            // Create new folder in bitrix24 disk
            $newFolder = $this->diskStorageAddFolder(5, ['NAME' => $product->id . '_prod']);
            $bxProductPreview = null;

            if ($createFile !== null) {

                $findFile = ProductFiles::where('id', $createFile->id)->first();

                // Send files to Bitrix
                $bxProductPreview = $this->uploadfileDiskFolder(
                    isset($newFolder['result']) ? $newFolder['result']['ID'] : null,
                    $_FILES['file']['name'],
                    ['NAME' => $findFile->file]
                );

                $findFile->bx_file_id = isset($bxProductPreview['result'])? $bxProductPreview['result']['ID'] : null;

                if (isset($newFolder['result'])) {
                    $findFile->bx_folder_id = $newFolder['result']['ID'];
                }

                $findFile->save();
            }

            // Add product to bitrix24
            $bxProduct = $this->productAdd([
                'NAME' => $translationProduct->title,
                'SECTION_ID' => 6,
                'CURRENCY_ID' => 'AMD',
                'PRICE' => $request->input('price'),
                'PROPERTY_58' => [
                    'VALUE' => $product->id
                ],
                'PROPERTY_56' => [
                    'VALUE' => $translationProduct->description
                ],
                'PREVIEW_PICTURE' => $bxProductPreview,
                'PROPERTY_59' => isset($newFolder['result']) ? $newFolder['result']['ID'] : null
            ]);

            if (isset($bxProduct['result'])) {

                $product->bx_product_id = $bxProduct['result'];

                if ($product->save()) {
                    return redirect()
                        ->route('admin.product.index', $request->input('sale_type_id'))
                        ->with('success', __('admin.product_created_success'));
                }

            } else {
                return redirect()
                    ->route('admin.product.index', $request->input('sale_type_id'))
                    ->with('error', __('admin.product_created_success_bx_error') . ' Error: ' . $bxProduct['error_description']);
            }
        } else {
            return redirect()
                ->route('admin.product.index', $request->input('sale_type_id'))
                ->with('success', __('admin.product_created_success'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        if (empty($product)) {
            abort(404);
        }

        $saleType = SaleType::where('id', $id)->first();
        $catalog = Catalog::all();
        $languages = DocumentLanguages::all();
        return view('admin.product.edit', compact('product', 'saleType', 'catalog', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $rules = RuleFactory::make([
            '%title%' => 'required|string',
            '%description%' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        if ($request->input('sale_type_id') == 3) {
            $rules = RuleFactory::make([
                '%title%' => 'required|string',
                '%description%' => 'nullable|string',
                'price' => 'nullable|numeric',
                'file.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
            ]);
        }

        if ($request->input('sale_type_id') == 2) {
            $rules = RuleFactory::make([
                '%title%' => 'required|string',
                'file.*' => 'required|file|mimes:doc,pdf,docx|max:25000',
                'preview_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
            ]);
        }

        if ($request->input('sale_type_id') == 1) {
            $rules = RuleFactory::make([
                '%title%' => 'required|string',
                '%description%' => 'nullable|string',
                'price' => 'required|numeric',
                'file.*' => 'required|mimes:pdf|max:25000',
                'preview_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
            ]);
        }

        $request->validate($rules);

        $product = Product::findOrFail($id);
        $product->user_id = \Auth::check() ? \Auth::user()->id : null;
        $product->sale_type_id = $request->input('sale_type_id');
        $product->price = $request->input('price');
        $product->language = $request->input('language');
        $product->save();

        $product->catalog()->sync($request->input('catalog'));

        $translationProduct = Product::withTrashed()->findOrFail($product->id);
        $translationProduct->update([
            'en' => [
                'title' => $request->input('en')['title'],
                'description' => !empty($request->input('en')['description'])? $request->input('en')['description'] : null
            ],
            'ru' => [
                'title' => $request->input('ru')['title'],
                'description' => !empty($request->input('ru')['description'])? $request->input('ru')['description'] : null
            ],
            'hy' => [
                'title' => $request->input('hy')['title'],
                'description' => !empty($request->input('hy')['description'])? $request->input('hy')['description'] : null
            ]
        ]);

        // Upload files
        $updateFile = ProductFiles::createFile($product->id, $request);

        if ($request->input('sale_type_id') == 3) {

            $newFolder = $this->diskStorageAddFolder(5, ['NAME' => $product->id . '_prod']);
            $bxProductPreview = null;

            if ($updateFile !== null) {

                $findFile = ProductFiles::where('product_id', $updateFile->product_id)->first();

                // Send files to Bitrix
                $bxProductPreview = $this->uploadfileDiskFolder(
                    isset($newFolder['result']) ? $newFolder['result']['ID'] : null,
                    $_FILES['file']['name'],
                    ['NAME' => $findFile->file]
                );

                $findFile->bx_file_id = isset($bxProductPreview['result'])? $bxProductPreview['result']['ID'] : null;

                if (isset($newFolder['result'])) {
                    $findFile->bx_folder_id = $newFolder['result']['ID'];
                }

                $findFile->save();
            }

            $bxProduct = $this->productUpdate($product->bx_product_id, [
                'NAME' => $translationProduct->title,
                'SECTION_ID' => 6,
                'CURRENCY_ID' => 'AMD',
                'PRICE' => $request->input('price'),
                'PROPERTY_58' => [
                    'VALUE' => $id
                ],
                'PROPERTY_56' => [
                    'VALUE' => $translationProduct->description
                ],
                'PREVIEW_PICTURE' => $bxProductPreview,
                'PROPERTY_59' => isset($newFolder['result']) ? $newFolder['result']['ID'] : null
            ]);

            if (isset($bxProduct['result'])) {

                $product->bx_product_id = $bxProduct['result'];

                if ($product->save()) {
                    return redirect()
                        ->route('admin.product.index', $request->input('sale_type_id'))
                        ->with('success', __('admin.product_updated_success'));
                }

            } else {
                return redirect()
                    ->route('admin.product.index', $request->input('sale_type_id'))
                    ->with('error', __('admin.product_updated_success_bx_error') . ' Error: ' . $bxProduct['error_description']);
            }

        } else {
            return redirect()
                ->route('admin.product.index', $request->input('sale_type_id'))
                ->with('success', __('admin.product_updated_success'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $product = Product::with('productFiles')->where('id', $request->id)->first();
        $product->productFiles()->delete();

        if ($product->delete()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $product = Product::with('productFiles')->where('id', $request->id)->first();
        $product->productFiles()->destroy();

        if ($product->destroy()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    /**
     * Rollback the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rollback(Request $request)
    {
        $product = Product::withTrashed()->findOrFail($request->id);
        $product->restore();

        $product->productFiles()->restore();

        return response()->json(['status' => true]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function duplicate($id)
    {
        $findProduct = Product::findOrFail($id);
        $product = $findProduct->replicate();
        $product->save();

        foreach (['en', 'ru', 'hy'] as $locale) {
            $product->translateOrNew($locale)->title = $findProduct->title;
        }
        $product->save();

        return redirect(route('admin.product.edit', $product->id))->with(['product' => $product]);
    }
}
