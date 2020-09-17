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
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            {{ __('Credential info') }} - {{ $credentials->name }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container mt-4">

        <form action="{{ route('admin.credentials.update', $credentials->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <div class="row">

                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card">
                            <div class="card-header">{{ __('Credential picture') }}</div>
                            <div class="card-body text-center">

                                <div class="images">
                                    @if(!empty($credentials->image))

                                        <!-- Profile picture image-->
                                        <div class="img">
                                            <img src="{{ asset('storage/credentials/'.$credentials->image) }}" alt="{{ $credentials->name }}">
                                            <span class="remove-pic result_file"
                                                  data-file-id="{{ $credentials->id }}"
                                                  data-file-url="/admin/request/remove-credential-image"
                                                  data-title="Are you sure you want to remove this file?"
                                                  data-confirm-text="Delete"
                                                  data-cancel-text="Cancel"><i class="fal fa-times"></i></span>
                                        </div>
    {{--                                    <img class="img-account-profile rounded-circle mb-2" src="{{ asset('storage/our-team/'.$credentials->image) }}" alt="{{ $credentials->name }}" />--}}
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
                                                <a class="nav-link locale-{{ $locale }} switch-{{ $locale }} @if($key == 0) active @endif" href="javascript:void(0);" data-locale="{{ $locale }}">{{ \Illuminate\Support\Str::upper($locale) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    @foreach(config('app.locales') as $key => $locale)
                                        <div class="card-body switch-translatable-fields p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">
                                            <div class="form-group">
                                                <label class="required" for="{{ $locale }}_name">{{ trans('Member name') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                <input class="form-control @error($locale.'_name') is-invalid @enderror" type="text" name="{{ $locale }}_name" id="{{ $locale }}_name" value="{{ old($locale.'_name', $credentials->translate($locale)->name) }}" required>

                                                @error($locale.'_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>

                                            <div class="form-group">
                                                <label class="required" for="{{ $locale }}_description">{{ trans('Member description') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                                <input class="form-control @error($locale.'_description') is-invalid @enderror" type="text" name="{{ $locale }}_description" id="{{ $locale }}_description" value="{{ old($locale.'_description', $credentials->translate($locale)->description) }}" required>

                                                @error($locale.'_description')
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
