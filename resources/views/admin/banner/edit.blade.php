@extends('admin.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/css/file-field.css') }}">
@endpush

@section('content')

{{--    @dd($page->banners[0]->translate('en')->title)--}}

    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="arrow-right-circle"></i></div>
                            {{ __('Create new page') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-n10">
        <!-- Wizard card example with navigation-->
        <div class="card">
            <div class="card-header border-bottom">
                <!-- Wizard navigation-->
                <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab" role="tablist">
                    <!-- Wizard navigation item 1-->
                    <a class="nav-item nav-link" id="page-basics-tab" href="{{ url('admin/page/'.$banner->page_id.'/edit') }}">
                        <div class="wizard-step-icon">1</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Page Details') }}</div>
                            <div class="wizard-step-text-details">{{ __('Basic details and information') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 2-->
                    <a class="nav-item nav-link" id="page-content-tab" href="{{ url('admin/page-content/'.$banner->page->id.'/edit') }}">
                        <div class="wizard-step-icon">2</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Page Content') }}</div>
                            <div class="wizard-step-text-details">{{ __('Page content details') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 3-->
                    <a class="nav-item nav-link active" id="banner-tab" href="{{ url('admin/banner/'.$banner->id.'/edit') }}">
                        <div class="wizard-step-icon">3</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Banner') }}</div>
                            <div class="wizard-step-text-details">{{ __('Page banner details') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 4-->
                    <a class="nav-item nav-link" id="seo-tab" href="{{ url('admin/seo/'.$banner->page->seo->id.'/edit') }}">
                        <div class="wizard-step-icon">4</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('SEO') }}</div>
                            <div class="wizard-step-text-details">{{ __('Page SEO details') }}</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="cardTabContent">

                    <!-- Wizard tab pane item 3-->
                    <div class="tab-pane py-5 py-xl-10 fade show active" id="banner" role="tabpanel" aria-labelledby="banner-tab">
                        <div class="row justify-content-center">
                            <div class="col-xxl-6 col-xl-8">

                                <h3 class="text-primary">{{ __('Step') }} 3</h3>
                                <h5 class="card-title">{{ __('Page banner details') }}</h5>

                                <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Title translations -->
                                    <div class="translatable-form">
                                        <ul class="nav nav-tabs translatable-switcher mb-4">
                                            @foreach(config('app.locales') as $key => $locale)
                                                <li class="nav-item">
                                                    <a class="nav-link locale-{{ $locale }} switch-{{ $locale }} @if($key == 0) active @endif" href="javascript:void(0);" data-locale="{{ $locale }}">{{ \Illuminate\Support\Str::upper($locale) }}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                        @foreach(config('app.locales') as $key => $locale)
                                            <div class="card-body switch-translatable-fields p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">
                                                <div class="form-group">
                                                    <label class="required" for="{{ $locale }}_title">{{ trans('Banner title') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                    <input class="form-control @error($locale.'.title') is-invalid @enderror" type="text" name="{{ $locale }}[title]" id="{{ $locale }}_title" value="{{ old($locale.'.title', $banner->translate($locale)->title) }}">

                                                    @error($locale.'.title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- .end Title translations -->

                                    <!-- Description translations -->
                                    <div class="translatable-form">
                                        <ul class="nav nav-tabs translatable-switcher mb-4">
                                            @foreach(config('app.locales') as $key => $locale)
                                                <li class="nav-item">
                                                    <a class="nav-link locale-{{ $locale }} switch-{{ $locale }} @if($key == 0) active @endif" href="javascript:void(0);" data-locale="{{ $locale }}">{{ \Illuminate\Support\Str::upper($locale) }}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                        @foreach(config('app.locales') as $key => $locale)
                                            <div class="card-body switch-translatable-fields p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">
                                                <div class="form-group">
                                                    <label class="required" for="{{ $locale }}_description">{{ trans('Banner description') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                    <input class="form-control @error($locale.'.description') is-invalid @enderror" type="text" name="{{ $locale }}[description]" id="{{ $locale }}_description" value="{{ old($locale.'.description', $banner->translate($locale)->description) }}">

                                                    @error($locale.'.description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- .end Description translations -->

                                    <!-- Banner image -->
                                    <div class="file-field">
                                        <label for="banner-image"></label>
                                        <div class="images">

                                            @if(!empty($banner->image))
                                                <div class="img">
                                                    <img src="{{ asset('storage/banner/'.$banner->image) }}" alt="{{ $banner->translate($locale)->title }}">
                                                    <span class="remove-pic result_file"
                                                          data-file-id="{{ $banner->id }}"
                                                          data-file-url="/admin/request/remove-banner-image"
                                                          data-title="Are you sure you want to remove this file?"
                                                          data-confirm-text="Delete"
                                                          data-cancel-text="Cancel"><i class="fal fa-times"></i></span>
                                                </div>

                                                <div class="pic" style="display: none;">
                                                    <span style="font-size: 1.25rem;">Upload</span>
                                                    <input type="file" name="image" accept="image/*" class="file-uploader d-none form-control @error('image') is-invalid @enderror" id="banner-image">

                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @else
                                                <div class="pic">
                                                    <span style="font-size: 1.25rem;">Upload</span>
                                                    <input type="file" name="image" accept="image/*" class="file-uploader d-none form-control @error('image') is-invalid @enderror" id="banner-image">

                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- .end Banner image -->

                                    <hr class="my-3">

                                    <!-- Banner links -->
                                    <h3>Banner Links</h3>

                                    <div class="translatable-form mt-3">
                                        <ul class="nav nav-tabs translatable-switcher mb-4">
                                            @foreach(config('app.locales') as $key => $locale)
                                                <li class="nav-item">
                                                    <a class="nav-link locale-{{ $locale }} switch-{{ $locale }} @if($key == 0) active @endif" href="javascript:void(0);" data-locale="{{ $locale }}">{{ \Illuminate\Support\Str::upper($locale) }}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                        @foreach(config('app.locales') as $key => $locale)
                                            <div class="card-body switch-translatable-fields p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">
                                                <div class="form-group">
                                                    <label class="required" for="{{ $locale }}_link_title">{{ trans('Banner link title') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                    <input class="form-control @error($locale.'.link_title') is-invalid @enderror" type="text" name="{{ $locale }}[link_title][]" id="{{ $locale }}_link_title" value="{{ old($locale.'.link_title', $banner->translate($locale)->link_title) }}">

                                                    @error($locale.'.link_title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <label class="required" for="link">{{ trans('Link URL') }}</label>
                                    <div class="input-group input-group-joined mb-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i data-feather="link-2"></i>
                                            </span>
                                        </div>

                                        <input class="form-control @error('link') is-invalid @enderror" type="text" name="link[]" id="link" value="{{ old('link', $banner->link) }}">

                                        @error('link')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="translatable-form">
                                        <ul class="nav nav-tabs translatable-switcher mb-4">
                                            @foreach(config('app.locales') as $key => $locale)
                                                <li class="nav-item">
                                                    <a class="nav-link locale-{{ $locale }} switch-{{ $locale }} @if($key == 0) active @endif" href="javascript:void(0);" data-locale="{{ $locale }}">{{ \Illuminate\Support\Str::upper($locale) }}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                        @foreach(config('app.locales') as $key => $locale)
                                            <div class="card-body switch-translatable-fields p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">
                                                <div class="form-group">
                                                    <label class="required" for="{{ $locale }}_link_title">{{ trans('Banner link title') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                    <input class="form-control @error($locale.'_link_title') is-invalid @enderror" type="text" name="{{ $locale }}_link_title[]" id="{{ $locale }}_link_title" value="{{ old($locale.'_link_title', $banner->translate($locale)->link_title) }}">

                                                    @error($locale.'_link_title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <label class="required" for="link">{{ trans('Link URL') }}</label>
                                    <div class="input-group input-group-joined mb-5">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i data-feather="link-2"></i>
                                        </span>
                                        </div>

                                        <input class="form-control @error('link') is-invalid @enderror" type="text" name="link[]" id="link" value="{{ old('link', $banner->link) }}">

                                        @error('link')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <!-- .end Banner links -->

                                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>

                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset('admin/js/switch-translatable.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/select2.min.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/file-field.js') }}" type="text/javascript" defer></script>
@endpush
