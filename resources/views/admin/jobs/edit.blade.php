@extends('admin.layouts.app')

@section('content')

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="dollar-sign"></i></div>
                            {{ __('Job') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container mt-4">

        <form action="{{ route('admin.jobs.update', $jobs->id) }}" method="POST">
            @csrf
            @method('PUT')

                <div class="row">

                    <div class="col-xl-12">
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
                                                <label class="required" for="{{ $locale }}_title">{{ trans('Title') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                <input class="form-control @error($locale.'.title') is-invalid @enderror" type="text" name="{{ $locale }}[title]" id="{{ $locale }}_title" value="{{ old($locale.'.title', $jobs->translate($locale)->title) }}">

                                                @error($locale.'.title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>

                                        </div>
                                    @endforeach

                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-solid">
                                            <input class="custom-control-input" id="other-job" type="radio" name="form_type"  value="0" @if ($jobs->form_type == 0) checked @endif>
                                            <label class="custom-control-label" for="other-job">{{ __('Other job') }}</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-solid">
                                            <input class="custom-control-input" id="translation-job" type="radio" name="form_type"  value="1" @if ($jobs->form_type == 1) checked @endif>
                                            <label class="custom-control-label" for="translation-job">{{ __('Translation job') }}</label>
                                        </div>
                                    </div>

                                </div>
                                <!-- .end Name translations -->

                                <!-- Save changes button-->
                                <button class="btn btn-primary" type="submit">{{ __('Save changes') }}</button>
                                <a href="{{ url('/admin/jobs') }}" class="btn btn-light">{{ __('Cancel') }}</a>

                            </div>
                        </div>
                    </div>
                </div>

        </form>
    </div>

@endsection

@push('script')
    <script src="{{ asset('admin/js/switch-translatable.js') }}" type="text/javascript" defer></script>
@endpush
