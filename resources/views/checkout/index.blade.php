@extends('layouts.app')

@push('style')
    <style>
        .g-card-toggle-point {
            width: 25px;
            padding: 0;
            text-align: center;
            border: 0;
            color: #485765;
        }
    </style>
@endpush

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="g-title mb-5">{{ __('pages.Checkout') }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="g-wrapper">

                    <form action="{{ route('checkout.place.order') }}" method="POST" role="form">
                        @csrf

                        <input type="hidden" name="grand_total" value="{{ $sum }}">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group g-form-group">
                                    <label for="first-name">{{ __('forms.Name') }}</label>
                                    <input type="text" class="form-control g-form-control" value="{{ auth()->user()->name }}" name="first_name" id="first-name" aria-describedby="firstNameHelp" required>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group g-form-group">
                                    <label for="last-name">{{ __('forms.Last Name') }}</label>
                                    <input type="text" class="form-control g-form-control" value="{{ auth()->user()->last_name }}" name="last_name" id="last-name" aria-describedby="lastNameHelp" required>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group g-form-group">
                                    <label for="phone-number">{{ __('forms.Phone Number') }}</label>
                                    <input type="tel" class="form-control g-form-control" value="@if(!empty(auth()->user()->phone)) {{ auth()->user()->phone }} @endif" name="phone_number" id="phone-number" aria-describedby="phoneNumberHelp" required>

                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6"></div>
                            <div class="col-lg-6">
                                <div class="form-group g-form-group">
                                    <label for="delivery-check">{{ __('forms.Delivery address') }}</label>
                                    <label class="g-checkbox form-control g-form-control">
                                        <input type="checkbox" class="delivery-toggle-check" name="is_delivery" value="0" id="delivery-check"><span>{{ __('forms.Show') }}</span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-6 delivery-toggle-col">
                                <div class="form-group g-form-group">
                                    <label for="address">{{ __('forms.Address') }}</label>
                                    <input type="text" class="form-control g-form-control" value="@if(!empty(auth()->user()->address)) {{ auth()->user()->address }} @endif" name="address" id="address">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row payment-type-row">

                                    @if(!empty($paymentGateways))
                                        @foreach($paymentGateways as $payment)

                                            <div class="col-lg-6">
                                                <div class="form-group g-form-group payment-type-col">
                                                    <button class="g-btn g-btn-img w-100 payment-type-btn" type="button"><span><img src="{{ asset('storage/payment-gateways/'.$payment->icon) }}" alt="{{ $payment->name }}"><span>{{ $payment->name }}</span></span></button>
                                                    <input type="radio" class="payment-radio d-none" name="payment_method" value="{{ $payment->id }}">
                                                </div>

                                            </div>

                                        @endforeach
                                    @endif

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group g-form-group mb-0 text-center">
                                    <button type="submit" class="g-btn g-btn-blue g-btn-round text-uppercase">{{ __('forms.Place order') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex flex-column h-100">
                    <h2 class="blue-color font-size-3 mb-4">{{ __('pages.Order summary') }}</h2>
                    <div class="checkout-products-cards-list">

                        @if(count($carts) > 0)
                            @foreach($carts as $cart)
                                <div class="g-card-product g-card-product-2 g-card-wrap text-center">
                                    @if (!empty($cart->product->productFiles[0]))
                                        @if(checkFileMimeType($cart->product->productFiles[0]->file) === false)
                                            <div class="g-card-product-image text-uppercase d-flex justify-content-center align-items-center"
                                                 style="background-image: url({{ asset('images/svg/document.svg') }}); background-color: #fff; background-size: auto; font-size: 20px;">{{ fileBaseNameOrExtension($cart->product->productFiles[0]->file) }}</div>
                                        @endif
                                    @else
                                        <span style="background-image: url({{ asset('images/products/default-product.jpg') }})" class="g-card-product-image"></span>
                                    @endif

                                    @if(!empty($cart->product->productFiles[0]->preview_image))

                                        <!-- Preview Modal -->
                                        <div class="modal fade" id="card-image-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <p class="mb-0">{{ $cart->product->title }}</p>
                                                        <button type="button" class="close m-0 p-0 font-size-6" data-dismiss="modal" aria-label="Close">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/'.$cart->product->productFiles[0]->preview_image) }}" class="modal-image w-100" alt="{{ $cart->product->title }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="g-link g-link-1 font-size-7 mb-3" data-toggle="modal" data-target="#card-image-modal">{{ __('pages.Watch expert') }}</button>
                                    @endif
{{--                                    <span class="g-card-product-image" style="background-image: url(../images/products/product-1.png)"></span>--}}
                                    <p class="g-card-product-text">{{ $cart->product->title }}</p>
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <div class="simple-total-card g-card-wrap">
                        <span class="font-size-3">{{ __('pages.Total:') }}</span>
                        <span class="blue-color font-size-1">{{ $sum }}<span class="ml-2">AMD</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="g-message-btn-box"><a href="#" class="g-message-btn"></a></div>

@endsection
