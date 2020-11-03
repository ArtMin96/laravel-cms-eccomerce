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
        <form action="{{ route('search-document-shop') }}">
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
                <h1 class="g-title mb-5">{{ __('pages.Document Shop') }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="g-side-menu g-side-menu-3">
                    <div class="g-side-menu-title">{{ __('pages.Catalog') }}</div>
                    <ul class="g-side-menu-list">
                        @if(!empty($catalog))

                            <li class="g-side-menu-item @if(isset($_GET['catalog']) && $_GET['catalog'] == null) g-side-menu-active @endif">
                                @if(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName() == 'filter-product')
                                    {{ request()->query->remove('catalog') }}
                                    <a href="{{ route('filter-product', ['catalog' => null] + request()->all()) }}" class="g-side-menu-link">{{ __('pages.All') }}</a>
                                @else
                                    {{ request()->query->remove('catalog') }}
                                    <a href="{{ route('filter-product', ['catalog' => null]) }}" class="g-side-menu-link">{{ __('pages.All') }}</a>
                                @endif
                            </li>

                            @foreach($catalog as $key => $catalogs)
                                <li class="g-side-menu-item @if(isset($_GET['catalog']) && $_GET['catalog'] == $catalogs->id) g-side-menu-active @endif">
                                    @if(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName() == 'filter-product')
                                        {{ request()->query->remove('catalog') }}
                                        <a href="{{ route('filter-product', ['catalog' => $catalogs->id] + request()->all()) }}" class="g-side-menu-link">{{ $catalogs->title }}</a>
                                    @else
                                        {{ request()->query->remove('catalog') }}
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
                                                <input type="date" class="form-control g-form-control g-form-control-sm" id="filter-time" name="created" aria-describedby="filterTimeHelp" value="{{ request()->created }}">
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
                                                            <option value="{{ $locale->id }}" @if(request()->language == $locale->id) selected @endif>{{ $locale->name }}</option>
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
                                        @endif
                                    @else
                                        <img src="{{ asset('images/products/default-product.jpg') }}" class="g-card-product-basket-image" alt="{{ $product->title }}">
                                    @endif

                                    @if(!empty($product->productFiles[0]->preview_image))

                                        <!-- Preview Modal -->
                                        <div class="modal fade" id="card-image-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <p class="mb-0">{{ $product->title }}</p>
                                                        <button type="button" class="close m-0 p-0 font-size-6" data-dismiss="modal" aria-label="Close">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/'.$product->productFiles[0]->preview_image) }}" class="modal-image w-100" alt="{{ $product->title }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="g-link g-link-1 font-size-7" data-toggle="modal" data-target="#card-image-modal">{{ __('pages.Watch expert') }}</button>
                                    @endif

                                </div>
                                <div class="flex-grow-1">
                                    <div class="black-color font-weight-bold">{{ $product->title }}</div>
                                    <p class="green-color">{{ \Illuminate\Support\Str::limit($product->description, 80, '...') }}</p>
                                    <div class="text-right">
                                        <div class="black-color font-size-5 font-weight-bold mt-2 pr-5">{{ number_format($product->price, 0, '.', '') }} <span>AMD</span></div>
                                        <button class="g-btn g-btn-grey g-btn-round text-capitalize">buy</button>

                                        @if(auth()->check())
                                            <form action="{{ route('cart.store') }}" method="POST" class="js--add-cart d-inline-block">
                                                @csrf

                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button class="g-btn blue-color"><i class="fas fa-shopping-cart"></i></button>
                                            </form>
                                        @else
                                            <button class="g-btn blue-color" style="cursor: pointer" data-toggle="modal" data-target="#loginModal"><i class="fas fa-shopping-cart"></i></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex align-items-center justify-content-center">
                            <h3 class="text-muted">{{ __('pages.There is no item') }}</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(!empty($products))

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {{ $products->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    @endif

    <div class="g-message-btn-box"><a href="#" class="g-message-btn"></a></div>

    @include('partials.Login')

@endsection

@push('script')

    <!-- Scripts -->
    <script defer>

        window.addEventListener('load', function () {

            $('body').on('submit', '.js--add-cart', function (e) {
                e.preventDefault();

                let id = $(this).closest('form').find('[name=product_id]').val();

                axios.post('{{ route('cart.store') }}', {
                    id: id
                })
                .then(function (response) {

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
