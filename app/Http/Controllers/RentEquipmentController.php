<?php

namespace App\Http\Controllers;

use App\Page;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class RentEquipmentController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $page = Page::where('page_number', '=', Page::RentEquipment)->first();
        $products = Product::where('sale_type_id', Product::RentEquipment)->paginate(20);
        return view('rent-equipment.index', [
            'page' => $page,
            'products' => $products
        ]);
    }

    public function addWishlist(Request $request) {
        if (!empty($request->post('id'))) {
            $user = User::find(1);
            $product = Product::find($request->post('id'));
            $wishlists = $user->wishlist();

            if ($user->wish($product)) {
                return response()->json(['status' => true, 'title' => 'Success', 'message' => $product->title.' added to your wishlist!']);
            } else {
                return response()->json(['status' => false, 'title' => 'Error', 'message' => 'Please try again!']);
            }
        }
    }
}
