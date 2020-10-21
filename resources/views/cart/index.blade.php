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
        <form action="{{ route('search-cart') }}">
            @csrf

            <div class="row">
                <div class="col-lg-3 d-none d-md-block"></div>
                <div class="col-lg-6">
                    <div class="g-search-input">
                        <input type="text" name="q" class="form-control g-form-control" value="@if (!empty($searchTerm)) {{ $searchTerm }} @endif">
                        <button type="submit" class="search-input-btn">{{ __('pages.Search') }}</button>
                    </div>
                </div>
                <div class="col-lg-3 d-none d-md-block"></div>
            </div>
        </form>

        <div class="row">
            <div class="col-12">
                <h1 class="g-title mb-5">{{ __('pages.Basket') }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div id="basket-cards-list" @if(count($carts) < 1) style="height: 100%;" @endif>

                    @if(count($carts) > 0)
                        @foreach($carts as $cart)
                            <div class="g-card-product-basket g-card-wrap">
                                <div class="g-card-product-basket-image-box">

                                    @if (!empty($cart->product->productFiles[0]))
                                        @if(checkFileMimeType($cart->product->productFiles[0]->file) === false)
                                            <div class="img-file-info g-card-product-basket-image text-uppercase d-flex justify-content-center align-items-center"
                                                 style="background-image: url({{ asset('images/svg/document.svg') }}); background-color: #fff; background-size: auto; font-size: 20px;">{{ fileBaseNameOrExtension($cart->product->productFiles[0]->file) }}</div>
                                            {{--                                            <img src="{{ asset('storage/products/'.$product->productFiles[0]->file) }}" class="g-card-product-basket-image" alt="{{ $product->title }}">--}}
                                        @endif
                                    @else
                                        <img src="{{ asset('images/products/default-product.jpg') }}" class="g-card-product-basket-image" alt="{{ $cart->product->title }}">
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

                                        <button class="g-link g-link-1 font-size-7" data-toggle="modal" data-target="#card-image-modal">{{ __('pages.Watch expert') }}</button>
                                    @endif

                                </div>

                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div class="black-color font-weight-bold">{{ $cart->product->title }}</div>
                                        <button class="g-btn p-0 red-color card-hidden-elem del-basket-card-btn js--remove-cart" data-cart-id="{{ $cart->id }}"><i class="fas fa-times"></i></button>
                                    </div>
                                    <p class="green-color">{{ \Illuminate\Support\Str::limit($cart->product->description, 80, '...') }}</p>
                                    <div class="g-card-toggle-buttons d-flex align-items-center">
                                        <form action="{{ route('cart.update') }}" method="POST">
                                            @csrf

                                            <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                            <button class="g-btn p-0 light-color g-card-toggle-btn js--update-quantity" data-role="minus"><i class="fas fa-minus-circle"></i></button>

                                            <input type="text" class="g-card-toggle-point mx-2" name="quantity" value="{{ $cart->quantity }}" readonly />

                                            <button class="g-btn p-0 light-color g-card-toggle-btn js--update-quantity" data-role="plus"><i class="fas fa-plus-circle"></i></button>
                                        </form>
                                    </div>
                                    <div class="text-right">
                                        <div class="black-color font-size-5 font-weight-bold mt-2">{{ $cart->product->price }} <span>AMD</span></div>
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
            <div class="col-lg-5">
                <div class="g-card-sum g-card-wrap">
                    <div class="g-card-sum-title">{{ __('pages.Amount') }}</div>
                    <div class="g-card-sum-row g-card-sum-row-product">
                        <div class="g-card-sum-index">{{ __('pages.Products') }} <span>@if(count($carts) > 0) {{ $carts->total() }} @else 0 @endif</span></div>
                    </div>
                    <div class="g-card-sum-row g-card-sum-row-total">
                        <div class="g-card-sum-index">{{ __('pages.Total') }}</div>
                        <div class="g-card-sum-point"><span>{{ $sum }}</span><span>AMD</span></div>
                    </div>

                    @if(count($carts) > 0)
                        <div class="d-flex justify-content-between mt-3">
                            <button class="g-btn red-color p-0 card-hidden-elem clear-basket-cards-btn js--clear-cart">
                                <i class="fas fa-times"></i> {{ __('pages.Clear basket') }}
                            </button>
                            <a href="{{ LaravelLocalization::localizeUrl('checkout') }}" class="g-btn g-btn-green g-btn-round text-uppercase">{{ __('pages.go to order') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(count($carts) > 0)

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {{ $carts->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    @endif

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

                axios.delete('/cart/' + id)
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

            $('body').on('click', '.js--clear-cart', function (e) {
                e.preventDefault();

                axios.post('{{ route('cart.clear') }}')
                    .then(function (response) {
                        window.location.reload();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            });

        });

    </script>

@endpush
