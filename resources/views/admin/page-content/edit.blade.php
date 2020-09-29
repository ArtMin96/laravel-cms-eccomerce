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
                    <a class="nav-item nav-link" id="page-basics-tab" href="{{ url('admin/page/'.$pageContent->page_id.'/edit') }}">
                        <div class="wizard-step-icon">1</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Page Details') }}</div>
                            <div class="wizard-step-text-details">{{ __('Basic details and information') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 2-->
                    <a class="nav-item nav-link active" id="page-content-tab" href="{{ url('admin/page-content/'.$pageContent->id.'/edit') }}">
                        <div class="wizard-step-icon">2</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Page Content') }}</div>
                            <div class="wizard-step-text-details">{{ __('Page content details') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 3-->
                    <a class="nav-item nav-link" id="banner-tab" href="{{ url('admin/banner/'.$pageContent->id.'/edit') }}">
                        <div class="wizard-step-icon">3</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Banner') }}</div>
                            <div class="wizard-step-text-details">{{ __('Page banner details') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 4-->
                    <a class="nav-item nav-link" id="seo-tab" href="{{ url('admin/seo/'.$pageContent->page->seo->id.'/edit') }}">
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
                            <div class="col-xxl-10 col-xl-8">

                                <h3 class="text-primary">{{ __('Step') }} 2</h3>
                                <h5 class="card-title">{{ __('Page content details') }}</h5>

                                <form action="{{ route('admin.page-content.update', $pageContent->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="page_id" value="{{ $pageContent->page->id }}">

                                    <div class="card card-header-actions mx-auto">
                                        <div class="card-header">
                                            <div class="card-header-row">
                                                {{ $pageContent->page->name }}
                                            </div>

                                            <div class="ml-auto">
                                                <button type="button" class="btn btn-blue btn-icon add-new-row">
                                                    <i data-feather="plus"></i>
                                                </button>
                                                <button type="button" class="btn btn-pink btn-icon mr-2 remove-row">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="p-3">

                                            <div class="row">
                                                <div class="col-sm-12 col-md-7">
                                                    <!-- Title translations -->
                                                    <div class="translatable-form">
                                                        <ul class="nav nav-tabs translatable-switcher mb-4">
                                                            @foreach(config('app.locales') as $key => $locale)
                                                                <li class="nav-item">
                                                                    <a class="nav-link locale-{{ $locale }} switch-{{ $locale }}
                                                                    @if($key == 0) active @endif
                                                                    @error($locale.'.title') text-danger @enderror
                                                                    @error($locale.'.description') text-danger @enderror" href="javascript:void(0);" data-locale="{{ $locale }}">{{ \Illuminate\Support\Str::upper($locale) }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>

                                                        @foreach(config('app.locales') as $key => $locale)
                                                            <div class="card-body switch-translatable-fields p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">
                                                                <div class="form-group">
                                                                    <label class="required" for="{{ $locale }}_title">{{ trans('Page content title') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                                    <input class="form-control @error($locale.'.title') is-invalid @enderror" type="text" name="{{ $locale }}[title][]" id="{{ $locale }}_title" value="{{ old($locale.'.title', !empty($pageContent->translate($locale)->title)? $pageContent->translate($locale)->title : '') }}">

                                                                    @error($locale.'.title')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror

                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="required" for="{{ $locale }}_description">{{ trans('Page content description') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                                    <input class="form-control @error($locale.'.description') is-invalid @enderror" type="text" name="{{ $locale }}[description][]" id="{{ $locale }}_description" value="{{ old($locale.'.description', !empty($pageContent->translate($locale)->description)? $pageContent->translate($locale)->description : '') }}">

                                                                    @error($locale.'.description')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror

                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <!-- .end Title translations -->

                                                    <hr />

                                                    <!-- Has link -->
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input toggle-page-content-buttons" type="checkbox" name="has_link[]" id="has_link" {{ ($pageContent->has_link == 1) ? 'checked' : '' }} />
                                                            <label class="custom-control-label" for="has_link">{{ __('Has link') }}</label>
                                                        </div>
                                                    </div>
                                                    <!-- .end Has link -->

                                                    <div class="page-content-create-button-group {{ ($pageContent->has_link == 1) ? '' : 'd-none' }}">
                                                        <!-- Button types -->
                                                        <div class="form-group">
                                                            <label class="required" for="button_type">{{ __('Button type') }}</label>
                                                            <select class="form-control" type="text" name="button_type[]" id="button_type">
                                                                <option value="">{{ __('Select button type') }}</option>
                                                                <option value="0">{{ __('Basic') }}</option>
                                                                <option value="1">{{ __('Filled') }}</option>
                                                            </select>
                                                        </div>
                                                        <!-- .end Button types -->

                                                        <!-- Link title -->
                                                        <div class="form-group">
                                                            <label class="required" for="url">{{ __('URL') }}</label>
                                                            <input class="form-control @error('url') is-invalid @enderror" type="text" name="url[]" id="url" value="{{ old('url', $pageContent->url) }}">

                                                            @error('url')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror

                                                        </div>
                                                        <!-- .end Link -->

                                                        <!-- Link title -->
                                                        <div class="form-group">
                                                            <label class="required" for="link_title">{{ __('Button title') }}</label>
                                                            <input class="form-control @error('link_title') is-invalid @enderror" type="text" name="link_title[]" id="link_title" value="{{ old('link_title', $pageContent->link_title) }}">

                                                            @error('link_title')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror

                                                        </div>
                                                        <!-- .end Link -->
                                                    </div>

                                                </div>
                                                <div class="col-sm-12 col-md-5">
                                                    <!-- Banner image -->
                                                    <div class="file-field">
                                                        <label for="page-content-image"></label>
                                                        <div class="images">

                                                            @if(!empty($pageContent->image))
                                                                <div class="img">
                                                                    <img src="{{ asset('storage/page-content/'.$pageContent->image) }}" alt="{{ $pageContent->title }}">
                                                                    <span class="remove-pic result_file"
                                                                          data-file-id="{{ $pageContent->id }}"
                                                                          data-file-url="/admin/request/remove-page-content-image"
                                                                          data-title="Are you sure you want to remove this file?"
                                                                          data-confirm-text="Delete"
                                                                          data-cancel-text="Cancel"><i class="fal fa-times"></i></span>
                                                                </div>

                                                                <div class="pic" style="display: none;">
                                                                    <span style="font-size: 1.25rem;">Upload</span>
                                                                    <input type="file" name="image" accept="image/*" class="file-uploader d-none form-control @error('image') is-invalid @enderror" id="page-content-image">
                                                                </div>
                                                            @else
                                                                <div class="pic">
                                                                    <span style="font-size: 1.25rem;">Upload</span>
                                                                    <input type="file" name="image" accept="image/*" class="file-uploader d-none form-control @error('image') is-invalid @enderror" id="page-content-image">
                                                                </div>
                                                            @endif
                                                        </div>

                                                        @error('image')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <!-- .end Banner image -->
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Update') }}</button>

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
    <script src="{{ asset('admin/js/pages.js') }}" type="text/javascript" defer></script>
@endpush
