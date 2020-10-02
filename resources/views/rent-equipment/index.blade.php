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
            <div class="col-12 mb-5">
                <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row">
                    <h1 class="g-title">{{ __('pages.Equipments') }}</h1>
                    <a href="../wish_list.html" class="g-btn g-btn-blue mt-2">{{ __('pages.Wish list') }}</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="g-side-menu g-side-menu-3">
                    <div class="g-side-menu-title">Text</div>
                    <ul class="g-side-menu-list">
                        <li class="g-side-menu-item g-side-menu-active"><a href="./equipments.html" class="g-side-menu-link">{{ __('pages.Equipments') }}</a></li>
                        <li class="g-side-menu-item"><a href="../forms/expert.html" class="g-side-menu-link">{{ __('pages.Experts') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row" id="equipment-cards-list">

                    @if(!empty($products))
                        @foreach($products as $key => $product)
{{--                            @dd($product->productFiles[0])--}}
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="g-card-product g-card-wrap">
                                    <span class="g-card-product-image" style="background-image: url('{{ asset('storage/products/'.$product->productFiles[0]->file)  }}')"></span>
                                    <p class="g-card-product-text">{{ $product->title }}</p>
                                    <div class="mt-2 d-flex justify-content-center">
                                        <a href="../forms/equipment_rent.html" class="g-btn g-btn-green g-btn-round mr-2">{{ __('pages.Rent now') }}</a>
                                        <button class="g-btn px-0 blue-color equipment-wish-btn"><i class="far fa-heart"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
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

@endsection
