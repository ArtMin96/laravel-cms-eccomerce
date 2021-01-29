<?php

namespace App\Http\Livewire\Wishlist;

use App\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Icon extends Component
{

    public $wishlistCount;

    protected $listeners = ['refreshIcon' => '$refresh'];

    public function render()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('livewire.wishlist.icon', ['wishCount' => $wishlist->count()]);
    }
}
