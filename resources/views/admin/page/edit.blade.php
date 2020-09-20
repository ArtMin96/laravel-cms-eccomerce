@extends('admin.layouts.app')

@section('content')

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
                    <a class="nav-item nav-link active" id="page-basics-tab" href="{{ url('admin/page/'.$page->id.'/edit') }}">
                        <div class="wizard-step-icon">1</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Page Details') }}</div>
                            <div class="wizard-step-text-details">{{ __('Basic details and information') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 2-->
                    <a class="nav-item nav-link" id="page-content-tab" href="{{ url('admin/page-content/'.$page->id.'/edit') }}">
                        <div class="wizard-step-icon">2</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Page Content') }}</div>
                            <div class="wizard-step-text-details">{{ __('Page content details') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 3-->
                    <a class="nav-item nav-link" id="banner-tab" href="{{ url('admin/banner/'.$page->banners->id.'/edit') }}">
                        <div class="wizard-step-icon">3</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Banner') }}</div>
                            <div class="wizard-step-text-details">{{ __('Page banner details') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 4-->
                    <a class="nav-item nav-link" id="seo-tab" href="{{ url('admin/seo/'.$page->seo->id.'/edit') }}">
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
                    <!-- Wizard tab pane item 1-->
                    <div class="tab-pane py-5 py-xl-10 fade show active" id="page-basics" role="tabpanel" aria-labelledby="page-basics-tab">
                        <div class="row justify-content-center">
                            <div class="col-xxl-6 col-xl-8">

                                <h3 class="text-primary">{{ __('Step') }} 1</h3>
                                <h5 class="card-title">{{ __('Enter page basic information') }}</h5>

                                <form action="{{ route('admin.page.update', $page->id) }}" method="POST">
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
                                                    <label class="required" for="{{ $locale }}_name">{{ trans('Page title') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                    <input class="form-control @error($locale.'_name') is-invalid @enderror" type="text" name="{{ $locale }}_name" id="{{ $locale }}_name" value="{{ old($locale.'_name', $page->translate($locale)->name) }}" required @if($page->base_page == 1) readonly disabled @endif>

                                                    @error($locale.'_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- .end Title translations -->

                                    <div class="form-group">
                                        <label class="required" for="alias">{{ trans('Page URL') }}</label>
                                        <input class="form-control @error('alias') is-invalid @enderror" type="text" name="alias" id="alias" value="{{ old('alias', ($page->alias == 'javascript:void(0);') ? '' : $page->alias) }}" required @if($page->base_page == 1) readonly disabled @endif>

                                        @error('alias')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <label class="required" for="parent_id">{{ trans('Parent page') }}</label>
                                        <select class="form-control @error('parent_id') is-invalid @enderror" type="text" name="parent_id" id="parent_id" @if($page->base_page == 1) readonly disabled @endif>
                                            <option value="">Select parent page</option>
                                            @if(!empty($pages))
                                                @foreach($pages as $pageOptions)
                                                    <option value="{{ $pageOptions->id }}" @if($page->parent_id == $pageOptions->id) selected @endif>{{ $pageOptions->translate(app()->getLocale())->name }}</option>

                                                    @if(!empty($pageOptions['childrenPages'][0]))
                                                        <optgroup label="{{ $pageOptions->name }}">
                                                        @foreach($pageOptions['childrenPages'] as $child)
                                                                <option value="{{ $child->id }}" @if($page->parent_id == $child->id) selected @endif>{{ $child->translate(app()->getLocale())->name }}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>

                                        @error('parent_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <label class="required" for="sort_order">{{ trans('Page Sort') }}</label>
                                        <input class="form-control @error('sort_order') is-invalid @enderror" type="text" name="sort_order" id="sort_order" value="{{ old('sort_order', $page->sort_order) }}" required @if($page->base_page == 1) readonly disabled @endif>

                                        @error('sort_order')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>

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
@endpush
