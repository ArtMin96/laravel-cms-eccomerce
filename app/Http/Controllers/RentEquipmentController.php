<?php

namespace App\Http\Controllers;

use App\Contracts\OrderContract;
use App\Page;
use App\Product;
use App\User;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class RentEquipmentController extends Controller
{

    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $page = Page::where('page_number', '=', Page::RentEquipment)->first();
        $products = Product::where('sale_type_id', Product::RentEquipment)->paginate(8);

        if (\Auth::check()) {
            $wishlists = Wishlist::where('user_id', Auth::id())->get();
        } else {
            $wishlists = [];
        }

        return view('rent-equipment.index', [
            'page' => $page,
            'products' => $products,
            'wishlists' => $wishlists,
        ]);
    }

    public function rent($id)
    {
        $rentProduct = Product::find($id);

        if (empty($rentProduct)) {
            abort(404);
        }

        return view('rent-equipment.rent', compact('rentProduct'));
    }

    public function placeRent(Request $request)
    {


        $request->validate([
            'first_name' => 'required|min:2',
            'company' => 'required_if:person_type,1|min:2',
            'email' => 'required|string|email|max:255|unique:users,email,'.\Auth::user()->id.',id',
            'phone' => 'phone:AM', // AM Change to $this->getGeocodeCountryCode()
        ]);

//        dd(auth()->user()->bx_user_id);

        $product = Product::find($request->input('product_id'));

        $bxDealAdd = $this->DealAdd([
            'NAME' => $request->input('first_name'),
            'STAGE_ID' => 'PREPARATION',
            'CONTACT_ID' => auth()->user()->person_type == 0 ? auth()->user()->bx_user_id : null,
            'COMPANY_ID' => auth()->user()->person_type == 1 ? auth()->user()->bx_user_id : null,
            'UF_CRM_1570173600' => 65,
            'UF_CRM_1605255628778' => $request->input('event_day'),
            'UF_CRM_1605255644992' => $request->input('event_venue'),
        ]);

        if (!isset($bxDealAdd['result'])) {
            return redirect()
                ->route('rent-equipment')
                ->with('error', __('messages.problem_message') . ' Error: ' . $bxDealAdd['error_description']);
        }

        $addProductRows = $this->productRowsSet($bxDealAdd['result'], [
            'PRODUCT_ID' => $product->bx_product_id,
            'PRICE' => $product->price,
        ]);

        if (!isset($addProductRows['result'])) {
            return redirect()
                ->route('rent-equipment')
                ->with('error', __('messages.problem_message') . ' Error: ' . $addProductRows['error_description']);
        }

        $orderArr = [
            'first_name' => $request->input('first_name'),
            'phone_number' => $request->input('phone'),
            'grand_total' => 0,
            'item_count' => 1,
            'payment_method' => 0,
            'sale_type_id' => 3,
            'product_id' => $request->input('product_id'),
        ];

        $order = $this->orderRepository->storeOrderDetails($orderArr);

        return redirect()
            ->route('rent-equipment')
            ->with('success', __('messages.request_message'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function getSearch(Request $request)
    {
        $searchTerm = $request->get('q');

        if (empty($searchTerm)) {
            $products = Product::where('sale_type_id', Product::RentEquipment)->paginate(20);
        } else {
            $products = Product::whereLike(['productTranslations.title'], $searchTerm)->where('sale_type_id', Product::RentEquipment)->paginate(20);
        }

        $page = Page::where('page_number', '=', Page::RentEquipment)->first();

        if (\Auth::check()) {
            $user = User::find(\Auth::user()->id);
            $wishlists = $user->wishlist();
        } else {
            $wishlists = [];
        }

        return View::make('rent-equipment.index', compact('products', 'page', 'wishlists', 'searchTerm'));
    }
}
