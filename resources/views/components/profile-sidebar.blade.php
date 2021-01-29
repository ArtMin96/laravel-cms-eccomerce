<div class="g-side-menu g-side-menu-1">
    <div class="g-side-menu-title">text</div>
    <ul class="g-side-menu-list">
        <li class="g-side-menu-item g-side-menu-active side-menu-main-item"><a href="{{ route('orders.create-order') }}" class="g-side-menu-link">Create New order</a></li>
        <li class="side-menu-main-item side-menu-item-drop">
            <span class="g-side-menu-link side-menu-drop-toggle">My orders<i class="fas fa-angle-down light-color ml-2"></i></span>
            <ul class="side-menu-drop-list">
                <li class="g-side-menu-item @if(request()->type == 4) g-side-menu-active @endif"><a href="{{ route('orders.index', \App\Order::TRANSLATE_NOW) }}" class="g-side-menu-link">Translate now</a></li>
                <li class="g-side-menu-item @if(request()->type == 2) g-side-menu-active @endif"><a href="{{ route('orders.index', \App\Order::TRANSLATE_YOURSELF) }}" class="g-side-menu-link">Translate yourself</a></li>
                <li class="g-side-menu-item @if(request()->type == 1) g-side-menu-active @endif"><a href="{{ route('orders.index', \App\Order::DOCUMENT_SHOP) }}" class="g-side-menu-link">Documents online shop</a></li>
                <li class="g-side-menu-item @if(request()->type == 3) g-side-menu-active @endif"><a href="{{ route('orders.index', \App\Order::RENT_EQUIPMENT) }}" class="g-side-menu-link">Rent equipment</a></li>
            </ul>
        </li>
    </ul>
</div>
