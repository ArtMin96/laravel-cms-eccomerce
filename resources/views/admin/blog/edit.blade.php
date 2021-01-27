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
                            <div class="page-header-icon"><i data-feather="book"></i></div>
                            {{ __('admin.Edit') }} {{ __('admin.Blog') }} - {{ $blog->title }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container mt-4">

        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-header">{{ __('admin.Picture') }}</div>
                        <div class="card-body text-center">

                            <div class="images">

                            @if(!empty($blog->image))

                                <!-- Profile picture image-->
                                    <div class="img">
                                        <img src="{{ asset('storage/blog/'.$blog->image) }}" alt="{{ $blog->title }}">
                                        <span class="remove-pic result_file"
                                              data-file-id="{{ $blog->id }}"
                                              data-file-url="{{ LaravelLocalization::localizeUrl('admin/request/remove-blog-image') }}"
                                              data-title="{{ __('admin.remove_confirmation') }}"
                                              data-confirm-text="{{ __('admin.Delete') }}"
                                              data-cancel-text="{{ __('admin.Cancel') }}"><i class="fal fa-times"></i></span>
                                    </div>
                                @else
                                    <div class="pic">
                                        <span style="font-size: 1.25rem;">{{ __('admin.Upload') }}</span>
                                        <input type="file" name="image" accept="image/*" class="file-uploader d-none form-control @error('image') is-invalid @enderror" id="banner-image">
                                    </div>
                                @endif
                            </div>

                            @error('image')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="small font-italic text-muted mb-4">{{ __('admin.JPG, JPEG, PNG no larger than 3 MB') }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">{{ __('admin.Details') }}</div>

                        <div class="card-body">

                            <!-- Name translations -->
                            <div class="translatable-form">
                                <ul class="nav nav-tabs translatable-switcher mb-4">
                                    @foreach(config('app.locales') as $key => $locale)
                                        <li class="nav-item">
                                            <a class="nav-link locale-{{ $locale }} switch-{{ $locale }}
                                            @if($key == 0) active @endif
                                            @error($locale.'.title') text-danger @enderror
                                            @error($locale.'.description') text-danger @enderror" href="javascript:void(0);" data-locale="{{ $locale }}">
                                                {{ \Illuminate\Support\Str::upper($locale) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                                @foreach(config('app.locales') as $key => $locale)
                                    <div class="card-body switch-translatable-fields p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">
                                        <div class="form-group">
                                            <label class="required" for="{{ $locale }}_title">{{ __('admin.Title') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                            <input class="form-control @error($locale.'.title') is-invalid @enderror" type="text" name="{{ $locale }}[title]" id="{{ $locale }}_title" value="{{ old($locale.'.title', $blog->translate($locale)->title) }}">

                                            @error($locale.'.title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label class="required" for="{{ $locale }}_short_description">{{ __('admin.Short description') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                            <input class="form-control @error($locale.'.short_description') is-invalid @enderror" type="text" name="{{ $locale }}[short_description]" id="{{ $locale }}_short_description" value="{{ old($locale.'.short_description', $blog->translate($locale)->short_description) }}">

                                            @error($locale.'.short_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label class="required" for="{{ $locale }}_description">{{ __('admin.Description') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                            <input class="form-control @error($locale.'.description') is-invalid @enderror" type="text" name="{{ $locale }}[description]" id="{{ $locale }}_description" value="{{ old($locale.'.description', $blog->translate($locale)->description) }}">

                                            @error($locale.'.description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                    </div>
                                @endforeach

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox custom-control-solid">
                                        <input class="custom-control-input" name="is_img_card" value="1" id="customCheckSolid1" type="checkbox" @if($blog->is_img_card) checked @endif>
                                        <label class="custom-control-label" for="customCheckSolid1">{{ __('admin.image_card') }}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- .end Name translations -->

                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="submit">{{ __('admin.Save changes') }}</button>

                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

@endsection

@push('script')
    <script src="{{ asset('admin/js/switch-translatable.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/file-field.js') }}" type="text/javascript" defer></script>
@endpush
