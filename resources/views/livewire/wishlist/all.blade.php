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
                <div id="wish-cards-list">
                    @forelse($wishedItems as $item)

                        <div class="g-card-wish g-card-wrap">
                            <div class="d-flex justify-content-between">
                                <span>
                                    <label class="g-checkbox">
                                        <input type="checkbox" class="wish-card-check" wire:model="selectedItems" value="{{ $item->id }}">
                                        <span></span>
                                    </label>
                                </span>
                                <button class="g-btn red-color p-0 card-hidden-elem del-wish-card-btn"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="d-flex">
                                @if(!empty($item->product->productFiles[0]) || !empty($item->product->productFiles[0]->deleted_at))
                                    <span class="g-card-wish-image" style="background-image: url('{{ asset($item->product->productFiles[0]->url)  }}')"></span>
                                @else
                                    <span class="g-card-wish-image" style="background-image: url('{{ asset('images/products/default-product.jpg')  }}')"></span>
                                @endif

                                <div class="d-flex flex-column flex-grow-1">
                                    <div class="g-card-wish-body">
                                        <div>
                                            <p class="font-weight-bold">{{ $item->product->title }}</p>
                                            <div class="g-card-toggle-buttons d-flex align-items-center">
                                                <button class="g-btn p-0 light-color g-card-toggle-btn" data-role="minus"><i class="fas fa-minus-circle"></i></button>
                                                <span class="g-card-toggle-point mx-2">1</span>
                                                <button class="g-btn p-0 light-color g-card-toggle-btn" data-role="plus"><i class="fas fa-plus-circle"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <a href="forms/equipment_rent.html" class="g-btn g-btn-grey-ol g-btn-round text-capitalize wish-card-send disabled-link">{{ __('pages.send request') }}</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    @empty
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <h3 class="text-muted">{{ __('pages.There is no item') }}</h3>
                        </div>
                    @endforelse
                </div>

                <div class="row">
                    <div class="col-12 text-center">
                        <a wire:click.prevent="sendAll"
                           class="g-btn g-btn-grey-ol g-btn-round text-capitalize wish-cards-list-send @if($bulkDisabled) disabled-link @endif">
                            {{ __('pages.send request') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 d-none d-md-block"></div>
    </div>

{{--    @if (count($wishedItems) > 0)--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    {{ $wishedItems->links() }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}

</div>
