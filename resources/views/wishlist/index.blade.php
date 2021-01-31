@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="{{ route('search') }}">
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
    </div>

{{--    <livewire:wishlist.all />--}}

    <div class="container">

        <div class="row">
            <div class="col-12">
                <h2 class="g-title text-center mb-5">{{ __('pages.A wish list') }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-md-block"></div>
            <div class="col-lg-6">
                <div class="wish-list-box">

                    @if (count($wishlists) > 0)
                        <div id="wish-cards-list">

                            @foreach($wishlists as $wishlist)

                                <div class="g-card-wish g-card-wrap">
                                    <div class="d-flex justify-content-between">
                                        <span><label class="g-checkbox"><input type="checkbox" class="wish-card-check" name="wishlist[]"><span></span></label></span>
                                        <button class="g-btn red-color p-0 card-hidden-elem del-wish-card-btn"><i class="fas fa-times"></i></button>
                                    </div>
                                    <div class="d-flex">

                                        @if(!empty($wishlist->product->productFiles[0]) || !empty($wishlist->product->productFiles[0]->deleted_at))
                                            <span class="g-card-wish-image" style="background-image: url('{{ asset($wishlist->product->productFiles[0]->url)  }}')"></span>
                                        @else
                                            <span class="g-card-wish-image" style="background-image: url('{{ asset('images/products/default-product.jpg')  }}')"></span>
                                        @endif

                                        <div class="d-flex flex-column flex-grow-1">
                                            <div class="g-card-wish-body">
                                                <div>
                                                    <p class="font-weight-bold">{{ $wishlist->product->title }}</p>
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

                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <a href="forms/equipment_rent.html" class="g-btn g-btn-grey-ol g-btn-round text-capitalize wish-cards-list-send disabled-link">{{ __('pages.send request') }}</a>
                            </div>
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <h3 class="text-muted">{{ __('pages.There is no item') }}</h3>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 d-none d-md-block"></div>
        </div>
    </div>

    @if (count($wishlists) > 0)
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {{ $wishlists->links() }}
                </div>
            </div>
        </div>
    @endif

    <div class="g-message-btn-box"><a href="#" class="g-message-btn"></a></div>

@endsection

