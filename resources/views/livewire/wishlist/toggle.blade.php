<button wire:click.prevent="toggleWish({{ $productId }})" class="g-btn px-0 blue-color equipment-wish-btn">
    <i class="@if($isWished) fas @else far @endif fa-heart"></i>
</button>
