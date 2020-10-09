@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-3 d-none d-md-block"></div>
            <div class="col-lg-6">
                <div class="g-search-input">
                    <input type="search" class="form-control g-form-control">
                    <button class="search-input-btn">{{ __('pages.Search') }}</button>
                </div>
            </div>
            <div class="col-lg-3 d-none d-md-block"></div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2 class="g-title text-center mb-5">{{ __('pages.A wish list') }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-md-block"></div>
            <div class="col-lg-6">
                <div class="wish-list-box">
                    <div id="wish-cards-list">

                        @if (!empty($wishlists))
                            @foreach($wishlists as $wishlist)

                                <div class="g-card-wish g-card-wrap">
                                    <div class="d-flex justify-content-between">
                                        <span><label class="g-checkbox"><input type="checkbox" class="wish-card-check" name="wishlist[]"><span></span></label></span>
                                        <button class="g-btn red-color p-0 card-hidden-elem del-wish-card-btn"><i class="fas fa-times"></i></button>
                                    </div>
                                    <div class="d-flex">

                                        @if(!empty($wishlist->productFiles[0]) || !empty($wishlist->productFiles[0]->deleted_at))
                                            <span class="g-card-wish-image" style="background-image: url('{{ asset($wishlist->productFiles[0]->url)  }}')"></span>
                                        @else
                                            <span class="g-card-wish-image" style="background-image: url('{{ asset('images/products/default-product.jpg')  }}')"></span>
                                        @endif

                                        <div class="d-flex flex-column flex-grow-1">
                                            <div class="g-card-wish-body">
                                                <div>
                                                    <p class="font-weight-bold">{{ $wishlist->title }}</p>
                                                    <div class="g-card-toggle-buttons d-flex align-items-center">
                                                        <button class="g-btn p-0 light-color g-card-toggle-btn" data-role="minus"><i class="fas fa-minus-circle"></i></button>
                                                        <span class="g-card-toggle-point mx-2">1</span>
                                                        <button class="g-btn p-0 light-color g-card-toggle-btn" data-role="plus"><i class="fas fa-plus-circle"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right"><a href="forms/equipment_rent.html" class="g-btn g-btn-grey-ol g-btn-round text-capitalize wish-card-send disabled-link">{{ __('pages.send request') }}</a></div>
                                        </div>

                                    </div>
                                </div>

                            @endforeach
                        @else

                        @endif

                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="forms/equipment_rent.html" class="g-btn g-btn-grey-ol g-btn-round text-capitalize wish-cards-list-send disabled-link">{{ __('pages.send request') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 d-none d-md-block"></div>
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

