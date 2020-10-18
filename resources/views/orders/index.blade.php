@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="g-page-navigation g-page-navigation-user mt-5">
                    <div class="g-page-navigation-content">
                        <div class="g-page-navigation-title">{{ __('pages.Personal area') }}</div>
                        <ul class="g-page-navigation-list">
                            <li class="g-page-navigation-item g-page-navigation-active"><a href="#" class="g-page-navigation-link">Главная</a></li>
                            <li class="g-page-navigation-item"><a href="#" class="g-page-navigation-link">Личный кабинет</a></li>
                        </ul>
                    </div>
                    <div class="dropdown g-page-navigation-user-drop">
                        <div class="dropdown-toggle" id="dropdownNavigationUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="g-page-navigation-user-image" style="background-image: url(@if(!empty(Auth::user()->image)) {{ asset('storage/users/'.Auth::user()->image) }} @else {{ asset('images/users/default-profile-image.png') }} @endif"></span>
                            <span class="g-page-navigation-user-name">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</span>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownLangButton">
                            <li><a class="dropdown-item" href="{{ url('/profile/change-password') }}"><i class="fas fa-key"></i>{{ __('pages.Change password') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="g-side-menu g-side-menu-1">
                    <div class="g-side-menu-title">text</div>
                    <ul class="g-side-menu-list">
                        <li class="g-side-menu-item side-menu-main-item"><a href="./personal.html" class="g-side-menu-link">Create New order</a></li>
                        <li class="g-side-menu-item {{ Route::currentRouteName() == 'orders.index' ? 'g-side-menu-active' : '' }}">
                            <a href="{{ route('orders.index') }}" class="g-side-menu-link">My orders</a>
                        </li>
                        <li class="g-side-menu-item"><a href="./online_shop.html" class="g-side-menu-link">Translate now</a></li>
                        <li class="g-side-menu-item"><a href="./translate_yourselfs.html" class="g-side-menu-link">Translate yourself</a></li>
                        <li class="g-side-menu-item"><a href="online_shop_history.html" class="g-side-menu-link">Documents online shop</a></li>
                        <li class="g-side-menu-item"><a href="./rent_equipment.html" class="g-side-menu-link">Rent equipment</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-9">
                <div id="shop-history-cards-list" style="height: 100%">

                    @if(count($orders) > 0)
                        @foreach($orders as $order)
                            <div class="g-card-orderlist g-card-wrap">
                                <div class="g-card-orderlist-left">
                                    <div class="d-flex flex-column">
                                        <span class="text-capitalize blue-color font-weight-bold">{{ __('pages.Order') }} № <span>{{ $order->order_number }}</span></span>
                                        <span class="font-size-6"><span>{{ date('Y-m-d', strtotime($order->created_at)) }}</span></span>
                                        <span class="black-color font-size-5 font-weight-bold mt-2">{{ $order->grand_total }} <span>AMD</span></span>
                                    </div>
                                </div>
                                <p class="g-card-orderlist-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. A earum magnam, odio sed tempore totam.
                                </p>
                                <div class="g-card-orderlist-right">
                                    <div class="d-flex flex-column">
                                        <span class="blue-color font-size-7 text-capitalize">{{ __('pages.Status') }}:</span>

                                        <span class="green-color font-size-7 text-capitalize font-weight-bold" style="color: {{ $order->orderStatus->color }}">{{ $order->orderStatus->name }}</span>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <h3 class="text-muted">{{ __('pages.There is no item') }}</h3>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>

@endsection
