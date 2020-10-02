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
                            <div class="page-header-icon"><i data-feather="book-open"></i></div>
                            {{ __('Create product') }} - {{ $saleType->name }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container mt-4">

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="sale_type_id" value="{{ request()->route('id') }}">

            <div class="row">

                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card">
                        <div class="card-header">{{ __('Product file') }}</div>
                        <div class="card-body text-center">

                            <div class="images">
                                <div class="pic">
                                    <span style="font-size: 1.25rem;">Upload</span>
                                    <input type="file" name="file" class="file-uploader d-none form-control @error('file') is-invalid @enderror" id="file">
                                </div>
                            </div>

                            <!-- Profile picture help block-->
                            @error('file')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="small font-italic text-muted mb-4">{{ __('Rent Equipment: JPG or PNG no larger than 5 MB') }}</div>
                            <div class="small font-italic text-muted mb-4">{{ __('Document Shop: PDF no larger than 25 MB') }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <!-- Account details card-->
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
                                            <input class="form-control @error($locale.'.title') is-invalid @enderror" type="text" name="{{ $locale }}[title]" id="{{ $locale }}_title" value="{{ old($locale.'.title') }}">

                                            @error($locale.'.title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                    </div>
                                @endforeach
                            </div>
                            <!-- .end Name translations -->

                            <div class="form-group">
                                <label class="required" for="price">{{ __('Price') }}</label>
                                <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" id="price" value="{{ old('price') }}">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label class="required" for="catalog">{{ __('Catalog') }}</label>
                                <select class="js-select-multiple form-control w-100" id="catalog" name="catalog[]" multiple data-placeholder="Choose anything" data-allow-clear="1">
                                    @if (!empty($catalog))
                                        @foreach($catalog as $catalogOptions)
                                            <option value="{{ $catalogOptions->id }}">{{ $catalogOptions->title }}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>

                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="submit">{{ __('Save changes') }}</button>
                            <a href="{{ url('/admin/catalog') }}" class="btn btn-light">{{ __('Cancel') }}</a>

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
