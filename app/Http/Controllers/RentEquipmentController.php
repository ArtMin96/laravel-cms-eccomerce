<?php

namespace App\Http\Controllers;

use App\Page;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RentEquipmentController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $page = Page::where('page_number', '=', Page::RentEquipment)->first();
        $products = Product::where('sale_type_id', Product::RentEquipment)->paginate(8);

        if (\Auth::check()) {
            $user = User::find(\Auth::user()->id);
            $wishlists = $user->wishlist();
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

        $product = Product::find($request->input('product_id'));

        $bxDealAdd = $this->DealAdd([
            'NAME' => $request->input('first_name'),
            'STAGE_ID' => 'PREPARATION',
            'UF_CRM_1570173600' => 65
        ]);

        if (isset($bxDealAdd['result'])) {
            $addProductRows = $this->productRowsSet($bxDealAdd['result'], [
                'PRODUCT_ID' => $product->bx_product_id,
                'PRICE' => $product->price,
            ]);

            if (isset($addProductRows['result'])) {
                return redirect()
                    ->route('rent-equipment')
                    ->with('success', __('messages.request_message'));
            } else {
                return redirect()
                    ->route('rent-equipment')
                    ->with('error', __('messages.problem_message') . ' Error: ' . $addProductRows['error_description']);
            }

        } else {
            return redirect()
                ->route('rent-equipment')
                ->with('error', __('messages.problem_message') . ' Error: ' . $bxDealAdd['error_description']);
        }

    }

    public function addWishlist(Request $request) {
        if (!empty($request->post('id'))) {
            $user = User::find(\Auth::user()->id);
            $product = Product::find($request->post('id'));
            $wishlists = $user->wishlist();

            if ($user->wish($product)) {
                return response()->json(['status' => true, 'title' => 'Success', 'message' => $product->title.' added to your wishlist!']);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Please try again!']);
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function getSearch(Request $request)
    {
        $searchTerm = $request->get('q');

        $products = Product::whereLike(['productTranslations.title'], $searchTerm)->where('sale_type_id', Product::RentEquipment)->paginate(20);
        $page = Page::where('page_number', '=', Page::RentEquipment)->first();

        if (\Auth::check()) {
            $user = User::find(\Auth::user()->id);
            $wishlists = $user->wishlist();
        } else {
            $wishlists = [];
        }

        //return display search result to user by using a view
        return View::make('rent-equipment.index', compact('products', 'page', 'wishlists', 'searchTerm'));
    }
}
