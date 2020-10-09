<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index() {
        if (\Auth::check()) {
            $user = User::find(\Auth::user()->id);
            $wishlists = $user->wishlist();
        } else {
            $wishlists = [];
        }

        return view('wishlist.index', compact('wishlists'));
    }
}
