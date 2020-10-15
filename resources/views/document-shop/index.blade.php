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
        <div class="g-search-input">
            <input type="search" class="form-control g-form-control">
            <button class="search-input-btn">{{ __('pages.Search') }}</button>
        </div>

        <div class="row">
            <div class="col-12">
                <h1 class="g-title mb-5">{{ __('pages.Document Shop') }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="g-side-menu g-side-menu-3">
                    <div class="g-side-menu-title">{{ __('pages.Catalog') }}</div>
                    <ul class="g-side-menu-list">
                        @if(!empty($catalog))
                            @foreach($catalog as $catalogs)
                                <li class="g-side-menu-item @if(request()->catalog == $catalogs->id) g-side-menu-active @endif">
                                    @if(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName() == 'filter-product')
                                        <a href="{{ route('filter-product', request()->all() + ['catalog' => $catalogs->id]) }}" class="g-side-menu-link">{{ $catalogs->title }}</a>
                                    @else
                                        <a href="{{ route('filter-product', ['catalog' => $catalogs->id]) }}" class="g-side-menu-link">{{ $catalogs->title }}</a>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-12">
                        <div class="g-filter-bar mb-4">
                            <form action="{{ route('filter-product') }}" method="GET">
                                @csrf

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="g-filter-bar-col g-card-wrap">
                                            <div class="text-center font-weight-bold font-size-5 mb-3">{{ __('pages.Filter') }}</div>
                                            <div>
                                                <label class="g-checkbox" for="title">
                                                    <input class="form-check-input" type="checkbox" name="title" id="title">
                                                    <span>{{ __('pages.By name') }}</span>
                                                </label>
{{--                                                <label class="g-radio label-row d-block">--}}
{{--                                                    <input type="radio" name="title" value="0"><span>{{ __('pages.By name') }}</span>--}}
{{--                                                </label>--}}
{{--                                                <label class="g-radio label-row d-block"><input type="radio" name="title" value="1"><span>{{ __('pages.Alphabetically') }}</span></label>--}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="g-filter-bar-col g-card-wrap">
                                            <div class="text-center font-weight-bold font-size-5 mb-3">{{ __('pages.Time') }}</div>
                                            <div>
                                                <label for="filter-time" class="light-color">{{ __('pages.By time') }}</label>
                                                <input type="date" class="form-control g-form-control g-form-control-sm" id="filter-time" name="created" aria-describedby="filterTimeHelp" value="{{ request()->created_at }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="g-filter-bar-col g-card-wrap">
                                            <div class="text-center font-weight-bold font-size-5 mb-3">{{ __('pages.Filter') }}</div>
                                            <div>
                                                <label for="filter-lang-select" class="light-color">{{ __('pages.By language') }}</label>
                                                <select id="filter-lang-select" class="form-control g-form-control g-form-control-sm selectpicker" name="language" aria-describedby="filterLangHelp">
                                                    <option value="">{{ __('Choose language') }}</option>

                                                    @if(!empty($languages))
                                                        @foreach($languages as $locale)
                                                            <option value="{{ $locale->id }}">{{ $locale->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-right">
                                        <button type="submit" class="g-btn g-btn-blue-ol"><i class="fas fa-filter"></i> Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="document-shop-cards-list">

                    @if(count($products) > 0)
                        @foreach($products as $product)
                            <div class="g-card-product-basket g-card-wrap">
                                <div class="g-card-product-basket-image-box">
                                    @if (!empty($product->productFiles[0]))
                                        @if(checkFileMimeType($product->productFiles[0]->file) === false)
                                            <div class="img-file-info g-card-product-basket-image text-uppercase d-flex justify-content-center align-items-center"
                                                 style="background-image: url({{ asset('images/svg/document.svg') }}); background-color: #fff; background-size: auto; font-size: 20px;">{{ fileBaseNameOrExtension($product->productFiles[0]->file) }}</div>
{{--                                            <img src="{{ asset('storage/products/'.$product->productFiles[0]->file) }}" class="g-card-product-basket-image" alt="{{ $product->title }}">--}}
                                            <button class="g-link g-link-1 font-size-7" data-toggle="modal" data-target="#card-image-modal">Watch excerpt</button>
                                        @endif
                                    @else
                                        <img src="{{ asset('images/products/default-product.jpg') }}" class="g-card-product-basket-image" alt="{{ $product->title }}">
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <div class="black-color font-weight-bold">{{ $product->title }}</div>
                                    <p class="green-color">{{ \Illuminate\Support\Str::limit($product->description, 80, '...') }}</p>
                                    <div class="text-right">
                                        <div class="black-color font-size-5 font-weight-bold mt-2 pr-5">{{ number_format($product->price, 0, '.', '') }} <span>AMD</span></div>
                                        <button class="g-btn g-btn-grey g-btn-round text-capitalize">buy</button>
                                        <button class="g-btn blue-color"><i class="fas fa-shopping-cart"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex align-items-center justify-content-center">
                            <h3 class="text-muted">{{ __('pages.There is no product') }}</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(!empty($product))
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
    @endif

    <div class="g-message-btn-box"><a href="#" class="g-message-btn"></a></div>

@endsection
