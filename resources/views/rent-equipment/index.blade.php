@extends('layouts.app')

@section('seo')
    @include('partials.Seo', ['seo' => $page->seo])
@endsection

@section('content')

    @if (!empty($page->banners->title))
        <section class="g-home-banner">
            <div class="g-banner-bg" style="background-image: url({{ asset('storage/banner/'.$page->banners->image)  }});"></div>
            <div class="g-banner-content">
                <div class="g-banner-description">
                    <h1 class="g-title">{{ $page->banners->title }}</h1>
                    <p class="font-size-2 g-banner-text">{{ $page->banners->description }}</p>
                </div>
                <div class="g-banner-buttons mt-5">
                    <a href="../user/document_shop.html" class="g-btn g-btn-green">Get your ready translation</a>
                    <a href="../user/document_templates.html" class="g-btn g-btn-green">Translate yourself</a>
                </div>
            </div>

            <div class="g-soc-box">
                <ul class="g-soc-wrap">
                    <li class="g-soc-item g-soc-location"><a href="https://www.google.com/maps/place/42+Tumanyan+St,+Yerevan,+Armenia/@40.187054,44.511407,18z/data=!4m5!3m4!1s0x406abd1db99c3ce1:0x8663c432835d1d5c!8m2!3d40.1870543!4d44.5114073?hl=en" target="_blank" class="g-soc-link"><span>{{ settings()->address }}</span></a></li>
                    <li class="g-soc-item g-soc-phone"><a href="tel:+{{ settings()->phoneNumbers[0]->phone_number }}" class="g-soc-link"><span>+{{ settings()->phoneNumbers[0]->phone_number }}</span></a></li>
                    <li class="g-soc-item g-soc-mail"><a href="mailto:{{ settings()->email }}" class="g-soc-link"><span>{{ settings()->email }}</span></a></li>
                </ul>
            </div>
        </section>
    @endif

    <div class="container">
        <form action="{{ route('search-product') }}">
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
            <div class="col-12 mb-5">
                <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row">
                    <h1 class="g-title">{{ __('pages.Equipments') }}</h1>
                    <livewire:wishlist.icon />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="g-side-menu g-side-menu-3">
                    <div class="g-side-menu-title">Text</div>
                    <ul class="g-side-menu-list">
                        <li class="g-side-menu-item g-side-menu-active"><a href="{{ LaravelLocalization::localizeUrl('/rent-equipment') }}" class="g-side-menu-link">{{ __('pages.Equipments') }}</a></li>
                        <li class="g-side-menu-item"><a href="{{ LaravelLocalization::localizeUrl('/experts') }}" class="g-side-menu-link">{{ __('pages.Experts') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">

                @if (\Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ __('admin.success') }}</strong> {!! \Session::get('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (\Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ __('admin.error') }}</strong> {!! \Session::get('error') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row" id="equipment-cards-list">

                    @if(!empty($products))
                        @foreach($products as $key => $product)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="g-card-product g-card-wrap">

                                    @if(!empty($product->productFiles[0]) || !empty($product->productFiles[0]->deleted_at))
                                        <span class="g-card-product-image" style="background-image: url('{{ asset($product->productFiles[0]->url)  }}')"></span>
                                    @else
                                        <span class="g-card-product-image" style="background-image: url('{{ asset('images/products/default-product.jpg')  }}')"></span>
                                    @endif

                                    <p class="g-card-product-text">{{ $product->title }}</p>
                                    <div class="mt-2 d-flex justify-content-center">
                                        <a href="{{ route('rent-equipment.rent', $product->id) }}" class="g-btn g-btn-green g-btn-round mr-2">{{ __('pages.Rent now') }}</a>

                                        @php
                                        if ($product->wished) {
                                            $isWished = true;
                                        } else {
                                            $isWished = false;
                                        }
                                        @endphp

                                        @if (Auth::check())
                                            <livewire:wishlist.toggle :productId="$product->id" :isWished="$isWished" />
                                        @else
                                            <button class="g-btn px-0 blue-color" data-toggle="modal" data-target="#loginModal">
                                                <i class="far fa-heart"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(!empty($products))

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    {{ $products->links() }}

                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-5">
                    <p>{{ __('pages.rent_equipment_text_1') }}</p>
                    <p class="purple-color">{{ __('pages.rent_equipment_text_2') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="g-message-btn-box"><a href="#" class="g-message-btn"></a></div>

    @include('partials.Login')

@endsection
