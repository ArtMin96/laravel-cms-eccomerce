@extends('admin.layouts.app')

@section('content')

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="dollar-sign"></i></div>
                            {{ __('Create job') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container mt-4">

        <form action="{{ route('admin.jobs.store') }}" method="POST">
            @csrf

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
                                            <a class="nav-link locale-{{ $locale }} switch-{{ $locale }} @if($key == 0) active @endif" href="javascript:void(0);" data-locale="{{ $locale }}">{{ \Illuminate\Support\Str::upper($locale) }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                @foreach(config('app.locales') as $key => $locale)
                                    <div class="card-body switch-translatable-fields p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">
                                        <div class="form-group">
                                            <label class="required" for="{{ $locale }}_title">{{ trans('Title') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                            <input class="form-control @error($locale.'_title') is-invalid @enderror" type="text" name="{{ $locale }}_title" id="{{ $locale }}_title" value="{{ old($locale.'_title') }}" required>

                                            @error($locale.'_title')
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
