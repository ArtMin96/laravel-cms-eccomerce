<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class WishlistController extends Controller
{
    public function index() {
        $user = User::find(Auth::id());
        $wishlists = $user->wishlists()->paginate(8);
        return view('wishlist.index', compact('wishlists'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function getSearch(Request $request)
    {
        $searchTerm = $request->get('q');
        $user = User::find(Auth::id());

        if (!empty($searchTerm)) {
            $wishlists = $user->wishlists()->whereHas('product', function ($q) use ($searchTerm) {
                $q->whereLike(['productTranslations.title'], $searchTerm);
            })->paginate(8);
        } else {
            $wishlists = $user->wishlists()->paginate(8);
        }

        //return display search result to user by using a view
        return View::make('wishlist.index', compact('wishlists','searchTerm'));
    }
}
