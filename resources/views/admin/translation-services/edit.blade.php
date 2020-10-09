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
@endpush

@section('content')

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="columns"></i></div>
                            {{ __('Translation service') }} - {{ $translationServices->title }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container mt-4">

        <form action="{{ route('admin.translation-services.update', $translationServices->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <div class="row">

                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card">
                            <div class="card-header">{{ __('Translation service picture') }}</div>
                            <div class="card-body text-center">

                                <div class="images">
                                    @if(!empty($translationServices->icon))

                                        <!-- Profile picture image-->
                                        <div class="img">
                                            <img src="{{ asset('storage/translation-services/'.$translationServices->icon) }}" alt="{{ $translationServices->title }}">
                                            <span class="remove-pic result_file"
                                                  data-file-id="{{ $translationServices->id }}"
                                                  data-file-url="{{ LaravelLocalization::localizeUrl('/admin/request/remove-translation-service-image') }}"
                                                  data-title="Are you sure you want to remove this file?"
                                                  data-confirm-text="Delete"
                                                  data-cancel-text="Cancel"><i class="fal fa-times"></i></span>
                                        </div>
                                    @else
                                        <div class="pic">
                                            <span style="font-size: 1.25rem;">Upload</span>
                                            <input type="file" name="icon" accept="image/*" class="file-uploader d-none form-control @error('icon') is-invalid @enderror" id="banner-image">
                                        </div>
                                    @endif
                                </div>

                                @error('icon')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <!-- Profile picture help block-->
                                <div class="small font-italic text-muted mb-4">{{ __('JPG or PNG no larger than 5 MB') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header">Credential Details</div>

                            <div class="card-body">

                                <!-- Name translations -->
                                <div class="translatable-form">
                                    <ul class="nav nav-tabs translatable-switcher mb-4">
                                        @foreach(config('app.locales') as $key => $locale)
                                            <li class="nav-item">
                                                <a class="nav-link locale-{{ $locale }} switch-{{ $locale }}
                                                @if($key == 0) active @endif
                                                @error($locale.'.name') text-danger @enderror
                                                @error($locale.'.description') text-danger @enderror" href="javascript:void(0);" data-locale="{{ $locale }}">
                                                    {{ \Illuminate\Support\Str::upper($locale) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    @foreach(config('app.locales') as $key => $locale)
                                        <div class="card-body switch-translatable-fields p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">
                                            <div class="form-group">
                                                <label class="required" for="{{ $locale }}_title">{{ trans('Translation service name') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                <input class="form-control @error($locale.'.title') is-invalid @enderror" type="text" name="{{ $locale }}[title]" id="{{ $locale }}_title" value="{{ old($locale.'.title', $translationServices->translate($locale)->title) }}">

                                                @error($locale.'.title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>

                                            <div class="form-group">
                                                <label class="required" for="{{ $locale }}_description">{{ trans('Translation service description') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                <input class="form-control @error($locale.'.description') is-invalid @enderror" type="text" name="{{ $locale }}[description]" id="{{ $locale }}_description" value="{{ old($locale.'.description', $translationServices->translate($locale)->description) }}">

                                                @error($locale.'.description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                                <!-- .end Name translations -->

                                <!-- Save changes button-->
                                <button class="btn btn-primary" type="submit">{{ __('Save changes') }}</button>

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
@endpush
