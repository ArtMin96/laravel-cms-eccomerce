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
        <form action="{{ route('search-document-template') }}">
            @csrf

            <input type="hidden" name="catalog" value="{{ isset($_GET['catalog'])? $_GET['catalog'] : null }}">
            <input type="hidden" name="language" value="{{ isset($_GET['language'])? $_GET['language'] : null }}">

            <div class="row">
                <div class="col-lg-3 d-none d-md-block"></div>
                <div class="col-lg-6">
                    <div class="g-search-input">
                        <input type="text" name="q" class="form-control g-form-control" value="@if (isset($_GET['q']) && !empty($_GET['q'])) {{ $_GET['q'] }} @endif">
                        <button type="submit" class="search-input-btn">{{ __('pages.Search') }}</button>
                    </div>
                </div>
                <div class="col-lg-3 d-none d-md-block"></div>
            </div>
        </form>

        <div class="row">

            <div class="col-lg-12">
                <div class="g-tabs g-tabs-2">

                    @if(count($languages) > 0)
                        <nav>
                            <div class="nav nav-pills" id="nav-tab" role="tablist">
                                {{ request()->query->remove('language') }}
                                <a class="nav-item nav-link @if(!isset($_GET['language']) && empty($_GET['language'])) active @endif" href="{{ route('document-template', ['catalog' => isset($_GET['catalog'])? $_GET['catalog'] : null]) }}">{{ __('pages.All') }}</a>

                                @foreach($languages as $key => $lang)

                                    @if($lang->id == 3)
                                        @continue
                                    @endif

                                    {{ request()->query->remove('language') }}

                                    @if(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName() == 'search-document-template')
                                        <a class="nav-item nav-link @if(isset($_GET['language']) && $_GET['language'] == $lang->id) active @endif"
                                           href="{{ route('search-document-template', ['_token' => csrf_token(), 'q' => $_GET['q'], 'language' => $lang->id]) }}"
                                        >{{ $lang->name }}</a>
                                    @else
                                        <a class="nav-item nav-link @if(isset($_GET['language']) && $_GET['language'] == $lang->id) active @endif"
                                           href="{{ route('document-template', ['language' => $lang->id]) }}"
                                        >{{ $lang->name }}</a>
                                    @endif

                                @endforeach
                            </div>
                        </nav>
                    @endif

                    <div class="row" id="document-template-cards-list-1">

                        @if(count($products) > 0)

                            @foreach($products as $product)
                                <div class="col-xl-3 col-lg-4 col-md-6">
                                    <div class="g-card-document g-card-wrap">

                                        @if (!empty($product->productFiles[0]))
                                            <img src="{{ asset('document-templates/'.$product->productFiles[0]->preview_image) }}" class="g-card-product-basket-image" alt="{{ $product->title }}">
                                        @else
                                            <img src="{{ asset('images/products/default-product.jpg') }}" class="g-card-product-basket-image" alt="{{ $product->title }}">
                                        @endif

                                        @if(!empty($product->language))
                                            <p class="g-card-product-text my-3 h-auto">{{ __('pages.Language') }}: {{ $product->documentLanguage->name }}</p>
                                        @endif

                                        <p class="g-card-product-text mt-3 mb-0 h-auto">{{ $product->title }}</p>

                                        @if(auth()->check())
                                            <button class="g-btn g-btn-blue g-btn-round mt-3 text-capitalize document-template-link" data-toggle="modal" data-target="#document-{{ $product->id }}-modal"><i class="fas fa-edit"></i></button>

                                            <!-- Modals -->
                                            @include('partials.modals.Modals', ['id' => $product->id, 'language' => $product->language])
                                        @else
                                            <button class="g-btn g-btn-blue g-btn-round mt-3 text-capitalize document-template-link" data-toggle="modal" data-target="#loginModal"><i class="fas fa-edit"></i></button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                        @else
                            <div class="d-flex align-items-center justify-content-center w-100">
                                <h3 class="text-muted">{{ __('pages.There is no item') }}</h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($products))

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    @if(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName() == 'document-template')
                        {{ $products->appends(['language' => isset($_GET['language'])? $_GET['language'] : null], request()->input())->links() }}
                    @endif

                    @if(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName() == 'search-document-template')
                        {{ $products->appends(['_token' => csrf_token(), 'q' => $_GET['q'], 'language' => isset($_GET['language'])? $_GET['language'] : null], request()->input())->links() }}
                    @endif

                </div>
            </div>
        </div>
    @endif

    <div class="g-message-btn-box"><a href="#" class="g-message-btn"></a></div>

    @include('partials.Login')

@endsection
