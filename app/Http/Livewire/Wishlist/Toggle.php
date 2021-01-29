<?php

namespace App\Http\Livewire\Wishlist;

use App\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Toggle extends Component
{

    public $isWished;

    public $productId;

    public function mount($isWished)
    {
        $this->isWished = $isWished;
    }

    public function toggleWish()
    {
        $wishlist = Wishlist::where(['user_id' => Auth::id(), 'product_id' => $this->productId])->first();

        if (!$wishlist) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $this->productId
            ]);

            $this->isWished = true;

            $this->emit('show-toast', 'Success: Added to your wish list', 'success');
        } else {
            $wishlist->delete();

            $this->isWished = false;

            $this->emit('show-toast', 'Success: Removed from your wish list', 'success');
        }

        $this->emit('refreshIcon');
    }

    public function render()
    {
        return view('livewire.wishlist.toggle');
    }
}
