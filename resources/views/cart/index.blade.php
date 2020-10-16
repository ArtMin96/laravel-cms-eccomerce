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
        <div class="g-search-input">
            <input type="search" class="form-control g-form-control">
            <button class="search-input-btn">{{ __('pages.Search') }}</button>
        </div>

        <div class="row">
            <div class="col-12">
                <h1 class="g-title mb-5">{{ __('pages.Basket') }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div id="basket-cards-list">

                    @if(count($carts) > 0)
                        @foreach($carts as $cart)
                            <div class="g-card-product-basket g-card-wrap">
                                <div class="g-card-product-basket-image-box">
                                    <img src="../../images/cards/card-1.png" class="g-card-product-basket-image" alt="gaudeamus">
                                    <button class="g-link g-link-1 font-size-7" data-toggle="modal" data-target="#card-image-modal">{{ __('pages.Watch expert') }}</button>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between mb-2">
                                        <a href="#" class="g-link g-link-2 p-0 light-color basket-link"><span>15</span> <i class="fas fa-download"></i></a>
                                        <button class="g-btn p-0 red-color card-hidden-elem del-basket-card-btn js--remove-cart" data-cart-id="{{ $cart->id }}"><i class="fas fa-times"></i></button>
                                    </div>
                                    <div class="black-color font-weight-bold">{{ $cart->product->title }}</div>
                                    <p class="green-color">{{ \Illuminate\Support\Str::limit($cart->product->description, 80, '...') }}</p>
                                    <div class="g-card-toggle-buttons d-flex align-items-center">
                                        <form action="{{ route('cart.update') }}" method="POST">
                                            @csrf

                                            <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                            <button class="g-btn p-0 light-color g-card-toggle-btn js--update-quantity" data-role="minus"><i class="fas fa-minus-circle"></i></button>

                                            <input type="text" class="g-card-toggle-point mx-2" name="quantity" value="{{ $cart->quantity }}" />

                                            <button class="g-btn p-0 light-color g-card-toggle-btn js--update-quantity" data-role="plus"><i class="fas fa-plus-circle"></i></button>
                                        </form>
                                    </div>
                                    <div class="text-right">
                                        <div class="black-color font-size-5 font-weight-bold mt-2">{{ $cart->product->price }} <span>AMD</span></div>
                                        <button class="g-btn g-btn-grey g-btn-round text-capitalize">{{ __('pages.Buy') }}</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>

            </div>
            <div class="col-lg-5">
                <div class="g-card-sum g-card-wrap">
                    <div class="g-card-sum-title">{{ __('pages.Amount') }}</div>
                    <div class="g-card-sum-row g-card-sum-row-product">
                        <div class="g-card-sum-index">{{ __('pages.Products') }} <span>{{ count($carts) }}</span></div>
                    </div>
                    <div class="g-card-sum-row g-card-sum-row-total">
                        <div class="g-card-sum-index">{{ __('pages.Total') }}</div>
                        <div class="g-card-sum-point"><span>{{ $sum }}</span><span>AMD</span></div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button class="g-btn red-color p-0 card-hidden-elem clear-basket-cards-btn"><i class="fas fa-times"></i> {{ __('pages.Clear basket') }}</button>
                        <a href="#" class="g-btn g-btn-green g-btn-round text-uppercase">{{ __('pages.go to order') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="g-pagination g-pagination-2">
                    <span class="g-pagination-item g-pagination-active"><span>1</span></span>
                    <span class="g-pagination-item"><span>2</span></span>
                    <span class="g-pagination-item"><span>3</span></span>
                </div>
            </div>
        </div>
    </div>

    <div class="g-message-btn-box"><a href="#" class="g-message-btn"></a></div>

@endsection

@push('script')

    <!-- Scripts -->
    <script defer>

        window.addEventListener('load', function () {

            $('body').on('click', '.js--update-quantity', function (e) {
                e.preventDefault();

                let id = $(this).closest('form').find('[name=cart_id]').val();
                let quantity = $(this).closest('form').find('[name=quantity]').val();

                axios.patch('{{ route('cart.update') }}', {
                    id: id,
                    quantity: quantity
                })
                .then(function (response) {

                    $('.g-card-sum-point span:first').text(response.data.total);
                    
                    $(`
                        <div class="message-dialog g-card-wrap">
                            <span>${response.data.message}</span>
                        </div>
                    `).appendTo('body').slideToggle('slow');

                    setTimeout(()=>{
                        $('.message-dialog').fadeOut('slow', function(){ $(this).remove(); });
                    }, 4000);
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });

            });

            $('body').on('click', '.js--remove-cart', function (e) {
                e.preventDefault();

                let _this = $(this);
                let id = _this.attr('data-cart-id');

                axios.delete('cart/' + id)
                    .then(function (response) {

                        _this.closest('.g-card-product-basket.g-card-wrap').remove();
                        $('.g-card-sum-point span:first').text(response.data.total);
                        $('.g-card-sum-index span').text(response.data.count);

                        $(`
                            <div class="message-dialog g-card-wrap">
                                <span>${response.data.message}</span>
                            </div>
                        `).appendTo('body').slideToggle('slow');

                        setTimeout(()=>{
                            $('.message-dialog').fadeOut('slow', function(){ $(this).remove(); });
                        }, 4000);
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            });

        });

    </script>

@endpush
