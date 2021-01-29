<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class WishlistController extends Controller
{
    public function index() {
        return view('wishlist.index', compact('wishlists'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function getSearch(Request $request)
    {
        $searchTerm = $request->get('q');

        if (!empty($searchTerm)) {
            $wishlists = Product::whereLike(['productTranslations.title'], $searchTerm)->get();
        } else {
            $wishlists = Product::all();
        }

        //return display search result to user by using a view
        return View::make('wishlist.index', compact('wishlists','searchTerm'));
    }
}
