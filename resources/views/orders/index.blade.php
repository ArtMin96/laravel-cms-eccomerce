@extends('layouts.app')

@section('content')

    <div class="container">
        <x-profile-menu />

        <div class="row">
            <div class="col-12">
                <h2 class="g-title mb-5">
                    @if(request()->type == \App\Order::RENT_EQUIPMENT)
                        {{ __('pages.Rent equipment') }}
                    @elseif(request()->type == \App\Order::TRANSLATE_NOW)
                        {{ __('pages.event_button_title') }}
                    @elseif(request()->type == \App\Order::TRANSLATE_YOURSELF)
                        {{ __('pages.Translate yourself') }}
                    @elseif(request()->type == \App\Order::DOCUMENT_SHOP)
                        {{ __('pages.Document Online Shop') }}
                    @endif
                </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <x-profile-sidebar />
            </div>

            @if(request()->type == \App\Order::TRANSLATE_NOW || request()->type == \App\Order::DOCUMENT_SHOP && count($orders) > 0)
                <div class="col-lg-9">
                    <div id="shop-history-cards-list" style="height: 100%">
                        @foreach($orders as $order)
                            <div class="g-card-orderlist g-card-wrap">
                                <div class="g-card-orderlist-left">
                                    <div class="d-flex flex-column">
                                        <span class="text-capitalize blue-color font-weight-bold">{{ __('pages.Order') }} № <span>{{ $order->order_number }}</span></span>
                                        <span class="font-size-6"><span>{{ date('Y-m-d', strtotime($order->created_at)) }}</span></span>
                                        <span class="black-color font-size-5 font-weight-bold mt-2">{{ $order->grand_total }} <span>AMD</span></span>
                                    </div>
                                </div>
{{--                                    <p class="blue-color font-weight-bold">{{ $order->product->title }}</p>--}}
{{--                                    <p class="g-card-orderlist-body">--}}
{{--                                        {{ $order->product->description }}--}}
{{--                                    </p>--}}
                                <div class="g-card-orderlist-right">
                                    <div class="d-flex flex-column">
                                        <span class="blue-color font-size-7 text-capitalize">{{ __('pages.Status') }}:</span>

                                        <span class="green-color font-size-7 text-capitalize font-weight-bold" style="color: {{ $order->orderStatus->color }}">{{ $order->orderStatus->name }}</span>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @elseif(request()->type == \App\Order::TRANSLATE_YOURSELF && count($orders) > 0)
                <div class="col-lg-9">
                    <div class="row" id="downloads-cards-list">
                        <div class="col-lg-6">
                            <div class="g-card-doclist g-card-wrap">
                                <div class="g-card-doclist-document">
                                    <img src="../../images/document/document.png" alt="gaudeamus">
                                </div>
                                <div class="w-100">
                                    <div class="text-right">
                                        <a href="#" class="g-link g-link-2 blue-color font-size-7 p-0 download-history-link">Download <i class="fas fa-download"></i></a>
                                    </div>
                                    <div class="black-color font-weight-bold">Lorem ipsum</div>
                                    <p class="m-0">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquid impedit ipsum laborum officia, placeat.
                                    </p>
                                    <div class="font-size-7 grey-color text-right">21:07:2020</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="g-card-doclist g-card-wrap">
                                <div class="g-card-doclist-document">
                                    <img src="../../images/document/document.png" alt="gaudeamus">
                                </div>
                                <div class="w-100">
                                    <div class="text-right">
                                        <a href="#" class="g-link g-link-2 blue-color font-size-7 p-0 download-history-link">Download <i class="fas fa-download"></i></a>
                                    </div>
                                    <div class="black-color font-weight-bold">Lorem ipsum</div>
                                    <p class="m-0">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquid impedit ipsum laborum officia, placeat.
                                    </p>
                                    <div class="font-size-7 grey-color text-right">21:07:2020</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(request()->type == \App\Order::RENT_EQUIPMENT && count($orders) > 0)
                <div class="col-lg-9">
                    <div class="row" id="rent-equipment-cards-list">
                        @foreach($orders as $order)
                            <div class="col-lg-6">
                                <div class="g-card-rent g-card-wrap">
                                    <div class="g-card-rent-body">
                                        <div>
                                            <span class="text-capitalize blue-color font-weight-bold">{{ __('pages.Order') }} № <span>{{ $order->order_number }}</span></span>
                                            <span class="font-size-6 ml-2"><span class="mr-1">by</span><span>{{ date('d.m.Y', strtotime($order->created_at)) }}</span></span>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <span class="g-card-rent-image" style="background-image: url({{ $order->items[0]->product->image() }})"></span>
                                            <div>
                                                <span class="black-color font-size-6 font-weight-bold text-capitalize">{{ $order->items[0]->product->title }}</span>
                                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur.</p>
                                            </div>
                                        </div>
                                        <span class="black-color font-size-5 font-weight-bold mt-2">{{ $order->grand_total }} <span>AMD</span></span>
                                    </div>
                                    <div class="g-card-rent-right">
                                        <button class="g-btn p-0 red-color card-hidden-elem del-rent-equipment-btn"><i class="fas fa-times"></i></button>
                                        <div class="d-flex flex-column">
                                            <span class="blue-color font-size-7 text-capitalize">status:</span>
                                            <span class="green-color font-size-7 text-capitalize font-weight-bold">{{ $order->orderStatus->name }}</span>
                                            <span class="blue-color font-size-7 text-capitalize">Payment state:</span>
                                            <span class="green-color font-size-7 text-capitalize font-weight-bold">Invoicing</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="d-flex align-items-center justify-content-center h-100">
                    <h3 class="text-muted">{{ __('pages.There is no item') }}</h3>
                </div>
            @endif

            @if(count($orders) > 0)
                <div class="col-12">
                    {{ $orders->links() }}
                </div>
            @endif

        </div>
    </div>

@endsection
