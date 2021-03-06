@extends('admin.layouts.app')

@section('content')

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="help-circle"></i></div>
                            {{ __('Faq') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container mt-4">

        <form action="{{ route('admin.faqs.update', $faqs->id) }}" method="POST">
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
                                                <a class="nav-link locale-{{ $locale }} switch-{{ $locale }}
                                                @if($key == 0) active @endif
                                                @error($locale.'.question') text-danger @enderror @error($locale.'.answer') text-danger @enderror" href="javascript:void(0);" data-locale="{{ $locale }}">
                                                    {{ \Illuminate\Support\Str::upper($locale) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    @foreach(config('app.locales') as $key => $locale)
                                        <div class="card-body switch-translatable-fields p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">
                                            <div class="form-group">
                                                <label class="required" for="{{ $locale }}_question">{{ trans('Question') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                <input class="form-control @error($locale.'.question') is-invalid @enderror" type="text" name="{{ $locale }}[question]" id="{{ $locale }}_question" value="{{ old($locale.'_question', $faqs->question) }}">

                                                @error($locale.'.question')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>

                                            <div class="form-group">
                                                <label class="required" for="{{ $locale }}_answer">{{ trans('Answer') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                <input class="form-control @error($locale.'.answer') is-invalid @enderror" type="text" name="{{ $locale }}[answer]" id="{{ $locale }}_answer" value="{{ old($locale.'.answer', $faqs->answer) }}">

                                                @error($locale.'.answer')
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
@endpush
