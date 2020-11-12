@extends('admin.layouts.app')

@push('style')
    <style>
        .images {
            width: 160px;
            height: 160px;
            margin: 1rem auto 2rem;
        }
        .img, .pic {
            height: 160px !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('admin/css/file-field.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/select2-bootstrap4.min.css') }}">
@endpush

@section('content')

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="box"></i></div>
                            {{ __($product->title) }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container mt-4">

        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <input type="hidden" name="sale_type_id" value="{{ $product->saleType->id }}">

                <div class="row">

                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-header">{{ __('admin.Product file') }}</div>
                            <div class="card-body text-center">

                                <div class="images">
                                    @if(!empty($product->productFiles[0]->file))


                                        @if(checkFileMimeType($product->productFiles[0]->file) === false)
                                            <div class="img" style="background-image: url({{ asset('images/svg/document.svg') }}); background-color: #fff; background-size: auto; font-size: 32px;">
                                                <span class="remove-pic result_file"
                                                      data-file-id="{{ $product->productFiles[0]->id }}"
                                                      data-file-url="{{ LaravelLocalization::localizeUrl('/admin/request/remove-product-image') }}"
                                                      data-title="{{ __('admin.Are you sure you want to remove this file?') }}"
                                                      data-confirm-text="{{ __('admin.Delete') }}"
                                                      data-cancel-text="{{ __('admin.Cancel') }}"><i class="fal fa-times"></i></span>

                                                <div class="img-file-info text-uppercase">{{ fileBaseNameOrExtension($product->productFiles[0]->file) }}</div>
                                            </div>
                                        @else
                                            <div class="img">
                                                <img src="{{ asset('storage/products/'.$product->productFiles[0]->file) }}" alt="{{ $product->title }}">
                                                <span class="remove-pic result_file"
                                                      data-file-id="{{ $product->productFiles[0]->id }}"
                                                      data-file-url="{{ LaravelLocalization::localizeUrl('/admin/request/remove-product-image') }}"
                                                      data-title="{{ __('admin.Are you sure you want to remove this file?') }}"
                                                      data-confirm-text="{{ __('admin.Delete') }}"
                                                      data-cancel-text="{{ __('admin.Cancel') }}"><i class="fal fa-times"></i></span>
                                            </div>
                                        @endif
                                    @else
                                        <div class="pic">
                                            <span style="font-size: 1.25rem;">{{ __('admin.File') }}</span>
                                            <input type="file" name="file" class="file-uploader d-none form-control @error('file') is-invalid @enderror" id="file">
                                        </div>
                                    @endif
                                </div>

                                @error('file')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                @if($product->saleType->id == 1)
                                    <div class="small font-italic text-muted mb-4">{{ __('admin.PDF no larger than 25 MB') }}</div>
                                @elseif($product->saleType->id == 3)
                                    <div class="small font-italic text-muted mb-4">{{ __('admin.JPG, JPEG, PNG no larger than 5 MB') }}</div>
                                @endif

                                @if($product->sale_type_id == 1 || $product->sale_type_id == 2)
                                    <div class="images">
                                        @if(!empty($product->productFiles[0]->preview_image))

                                            <div class="img">
                                                <img src="{{ asset('storage/'.$product->productFiles[0]->preview_image) }}" alt="{{ $product->title }}">
                                                <span class="remove-pic result_file"
                                                      data-file-id="@if(!empty($product->productFiles[0]->bx_file_id)) {{ $product->productFiles[0]->bx_file_id }} @else {{ $product->productFiles[0]->id }} @endif"
                                                      data-file-url="{{ LaravelLocalization::localizeUrl('/admin/request/remove-product-preview-image') }}"
                                                      data-title="{{ __('admin.Are you sure you want to remove this file?') }}"
                                                      data-confirm-text="{{ __('admin.Delete') }}"
                                                      data-cancel-text="{{ __('admin.Cancel') }}"><i class="fal fa-times"></i></span>
                                            </div>
                                        @else
                                            <div class="pic">
                                                <span style="font-size: 1.25rem;">{{ __('admin.Preview image') }}</span>
                                                <input type="file" name="preview_image" accept="image/*" class="file-uploader d-none form-control @error('preview_image') is-invalid @enderror" id="preview-image">
                                            </div>
                                        @endif
                                    </div>

                                    @error('preview_image')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                @endif

                                @if($product->sale_type_id == 1 || $product->sale_type_id == 2)
                                    <div class="small font-italic text-muted mb-4">{{ __('admin.PDF, DOC, DOCX no larger than 25 MB') }}</div>
                                @endif

{{--                                <div class="small font-italic text-muted mb-4">{{ __('admin.JPG, JPEG, PNG no larger than 5 MB') }}</div>--}}
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">

                        <div class="card mb-4">

                            <div class="card-body">

                                <!-- Name translations -->
                                <div class="translatable-form">
                                    <ul class="nav nav-tabs translatable-switcher mb-4">
                                        @foreach(config('app.locales') as $key => $locale)
                                            <li class="nav-item">
                                                <a class="nav-link locale-{{ $locale }} switch-{{ $locale }} @if($key == 0) active @endif @error($locale.'.title') text-danger @enderror" href="javascript:void(0);" data-locale="{{ $locale }}">{{ \Illuminate\Support\Str::upper($locale) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    @foreach(config('app.locales') as $key => $locale)
                                        <div class="card-body switch-translatable-fields p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">
                                            <div class="form-group">
                                                <label class="required" for="{{ $locale }}_title">{{ __('Title') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                <input class="form-control @error($locale.'.title') is-invalid @enderror" type="text" name="{{ $locale }}[title]" id="{{ $locale }}_title" value="{{ old($locale.'.title', $product->translate($locale)->title) }}">

                                                @error($locale.'.title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>

                                            @if($product->sale_type_id == 1 || $product->sale_type_id == 3)
                                                <div class="form-group">
                                                    <label class="required" for="{{ $locale }}_description">{{ __('Description') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                    <textarea class="form-control @error($locale.'.description') is-invalid @enderror" name="{{ $locale }}[description]" id="{{ $locale }}_description">{{ old($locale.'.description', $product->translate($locale)->description) }}</textarea>

                                                    @error($locale.'.description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            @endif

                                        </div>
                                    @endforeach
                                </div>
                                <!-- .end Name translations -->

                                @if($product->sale_type_id == 1 || $product->sale_type_id == 3)

                                    <hr class="my-5">

                                    <div class="form-group">
                                        <label class="required" for="price">{{ __('Price') }}</label>
                                        <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" id="price" value="{{ old('price', $product->price) }}">

                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                @endif

                                @if($product->sale_type_id == 1 || $product->sale_type_id == 2)
                                    <div class="form-group">
                                        <label class="required" for="catalog">{{ __('Catalog') }}</label>
                                        <select class="js-select-multiple form-control w-100" id="catalog" name="catalog[]" multiple data-placeholder="Choose anything" data-allow-clear="1">
                                            @if (!empty($catalog))
                                                @foreach($catalog as $catalogOptions)
                                                    <option value="{{ $catalogOptions->id }}" @if ($product->catalog->containsStrict('id', $catalogOptions->id)) selected @endif>{{ $catalogOptions->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label class="required" for="language">{{ __('Language') }}</label>
                                        <select class="js-select-multiple form-control w-100" id="language" name="language" data-placeholder="Choose anything" data-allow-clear="1">
                                            <option value="">{{ __('Choose language') }}</option>

                                            @if(!empty($languages))
                                                @foreach($languages as $locale)
                                                    <option value="{{ $locale->id }}" @if ($product->language == $locale->id) selected @endif>{{ $locale->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                @endif

                                <!-- Save changes button-->
                                <button class="btn btn-primary" type="submit">{{ __('Save changes') }}</button>
                                <a href="{{ url('/admin/product/'.$product->sale_type_id) }}" class="btn btn-light">{{ __('Cancel') }}</a>

                            </div>
                        </div>
                    </div>
                </div>

        </form>
    </div>

@endsection

@push('script')
    <script src="{{ asset('admin/js/switch-translatable.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/select2.min.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/file-field.js') }}" type="text/javascript" defer></script>

    <script type="text/javascript">
        window.addEventListener('load', function() {
            $('select').select2({
                theme: 'bootstrap4',
            });
        });
    </script>

@endpush
