@extends('admin.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/css/select2.min.css') }}">
@endpush

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
                    <a class="nav-item nav-link active" id="page-basics-tab" href="#page-basics" data-toggle="tab" role="tab" aria-controls="page-basics" aria-selected="true">
                        <div class="wizard-step-icon">1</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Page Details') }}</div>
                            <div class="wizard-step-text-details">{{ __('Basic details and information') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 2-->
                    <a class="nav-item nav-link disabled" id="wizard2-tab" href="#wizard2" data-toggle="tab" role="tab" aria-controls="wizard2" aria-selected="true">
                        <div class="wizard-step-icon">2</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Page Content') }}</div>
                            <div class="wizard-step-text-details">{{ __('Page content details') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 3-->
                    <a class="nav-item nav-link disabled" id="wizard3-tab" href="#wizard3" data-toggle="tab" role="tab" aria-controls="wizard3" aria-selected="true">
                        <div class="wizard-step-icon">3</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Banner') }}</div>
                            <div class="wizard-step-text-details">{{ __('Page banner details') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 4-->
                    <a class="nav-item nav-link disabled" id="wizard4-tab" href="#wizard4" data-toggle="tab" role="tab" aria-controls="wizard4" aria-selected="true">
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

                                <form action="{{ route('admin.page.store') }}" method="POST">
                                    @csrf

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
                                                <div class="card-body p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">
                                                    <div class="form-group">
                                                        <label class="required" for="{{ $locale }}_name">{{ trans('Page title') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                        <input class="form-control @error($locale.'_name') is-invalid @enderror" type="text" name="{{ $locale }}_name" id="{{ $locale }}_name" value="{{ old($locale.'_name') }}" required>

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
                                        <input class="form-control @error('alias') is-invalid @enderror" type="text" name="alias" id="alias" value="{{ old('alias') }}" required>

                                        @error('alias')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <label class="required" for="parent_id">{{ trans('Parent page') }}</label>
                                        <select class="form-control @error('parent_id') is-invalid @enderror" type="text" name="parent_id" id="parent_id">
                                            <option value="">Select parent page</option>
                                            @if(!empty($pages))
                                                @foreach($pages as $page)
                                                    <option value="{{ $page->id }}">{{ $page->translate(app()->getLocale())->name }}</option>
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
                                        <input class="form-control @error('sort_order') is-invalid @enderror" type="text" name="sort_order" id="sort_order" value="{{ old('sort_order') }}" required>

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

    <script type="text/javascript" defer>
        window.addEventListener('load', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('keyup', '#en_name', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('admin.request.slug')}}",
                    method: 'get',
                    data: {
                        en_name: $(this).val()
                    },
                    dataType: "json",
                    success: function(result){
                        $('#alias').val(result.slug);
                        console.log(result.result);
                    },
                    done: function(result){
                        console.log(result.result);
                    },
                    error: function(jqXHR, exception) {
                        console.log(jqXHR);
                        console.log(exception);
                    }
                });
            });
        });
    </script>
@endpush
