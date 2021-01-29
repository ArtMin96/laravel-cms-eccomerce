<?php

namespace App\Http\Livewire\Wishlist;

use App\Product;
use App\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class All extends Component
{

    use WithPagination;

    /** @var array $selectedItems */
    public $selectedItems = [];

    /** @var bool $selectAll */
    public $selectAll = false;

    /** @var bool $bulkDisabled */
    public $bulkDisabled = true;

//    public function mount()
//    {
//        $this->selectedItems = collect();
//    }

    public function deleteSelected() // sendAll
    {
        Product::query()
            ->whereIn('id', $this->selectedItems)
            ->delete();

        $this->selectedItems = [];
        $this->selectAll = false;
    }

    public function updateSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = Product::pluck('id');
        } else {
            $this->selectedItems = [];
        }
    }

    public function render()
    {
        $this->bulkDisabled = count($this->selectedItems) < 1;

        $wishedItems = Wishlist::where(['user_id' => Auth::id()])->paginate(5);

        return view('livewire.wishlist.all', [
            'wishedItems' => $wishedItems
        ]);
    }
}
