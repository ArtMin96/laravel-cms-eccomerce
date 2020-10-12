@extends('admin.layouts.app')

@push('style')
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
                            {{ __('Settings') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active" href="{{ url('/admin/settings') }}">Settings</a>
            <a class="nav-link ml-0" href="account-profile.html">Profile</a>
        </nav>
        <hr class="mt-0 mb-4" />

        <form method="POST" action="{{ route('admin.settings.update', $settings->id) }}" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="row">

                <div class="col-lg-8">
                    <!-- Change password card-->
                    <div class="card mb-4">
                        <div class="card-body">

                            <!-- Title translations -->
                            <div class="translatable-form">
                                <ul class="nav nav-tabs translatable-switcher mb-4">
                                    @foreach(config('app.locales') as $key => $locale)
                                        <li class="nav-item">
                                            <a class="nav-link locale-{{ $locale }} switch-{{ $locale }}
                                            @if($key == 0) active @endif
                                            @error($locale.'.title') text-danger @enderror
                                            @error($locale.'.footer_title') text-danger @enderror
                                            @error($locale.'.footer_description') text-danger @enderror
                                            @error($locale.'.address') text-danger @enderror" href="javascript:void(0);" data-locale="{{ $locale }}">
                                                {{ \Illuminate\Support\Str::upper($locale) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                                @foreach(config('app.locales') as $key => $locale)
                                    <div class="card-body switch-translatable-fields p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">

                                        <div class="form-group">
                                            <label class="required" for="{{ $locale }}_title">{{ trans('Site title') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                            <input class="form-control @error($locale.'.title') is-invalid @enderror" type="text" name="{{ $locale }}[title]" id="{{ $locale }}_title" value="{{ old($locale.'.title', $settings->title) }}">

                                            @error($locale.'.title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label class="required" for="{{ $locale }}_footer_title">{{ trans('Site footer title') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                            <input class="form-control @error($locale.'.footer_title') is-invalid @enderror" type="text" name="{{ $locale }}[footer_title]" id="{{ $locale }}_footer_title" value="{{ old($locale.'.footer_title', $settings->footer_title) }}">

                                            @error($locale.'.footer_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label class="required" for="{{ $locale }}_footer_description">{{ trans('Site footer description') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                            <textarea class="form-control @error($locale.'.footer_description') is-invalid @enderror" name="{{ $locale }}[footer_description]" id="{{ $locale }}_footer_description">{{ old($locale.'.footer_description', $settings->footer_description) }}</textarea>

                                            @error($locale.'.footer_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <h4 class="mt-5 mb-4">{{ __('Contact information') }}</h4>

                                        <div class="form-group">
                                            <label class="required" for="{{ $locale }}_address">{{ trans('Address') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                            <input class="form-control @error($locale.'.address') is-invalid @enderror" type="text" name="{{ $locale }}[address]" id="{{ $locale }}_address" value="{{ old($locale.'.address', $settings->address) }}">

                                            @error($locale.'.address')
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
                                <label class="required" for="viber">{{ trans('Viber') }}</label>
                                <input class="form-control @error('viber') is-invalid @enderror" type="text" name="viber" id="viber" value="{{ old('viber', $settings->viber) }}" required>

                                @error('viber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label class="required" for="whatsapp">{{ trans('WhatsApp') }}</label>
                                <input class="form-control @error('whatsapp') is-invalid @enderror" type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $settings->whatsapp) }}" required>

                                @error('whatsapp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label class="required" for="map_html">{{ trans('Map HTML') }}</label>
                                <textarea class="form-control @error('map_html') is-invalid @enderror" name="map_html" id="map_html" required>{{ old('map_html', $settings->map_html) }}</textarea>

                                @error('map_html')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            @if(!empty($settings->map_html))
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3047.9728804019132!2d44.508568315831866!3d40.18741697939238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406abd1db4502f61%3A0x6e9670a2876e4843!2zR2F1ZGVhbXVzIFRyYW5zbGF0aW9uICYgSW50ZXJwcmV0YXRpb24v1LnVodaA1aPVtNWh1bbVudWh1a_VodW2INWu1aHVvNWh1bXVuNaC1anVtdW41oLVttW21aXWgA!5e0!3m2!1sru!2s!4v1600120477745!5m2!1sru!2s"
                                        width="100%"
                                        height="350"
                                        frameborder="0"
                                        style="border:0;"
                                        allowfullscreen=""
                                        aria-hidden="false"
                                        tabindex="0"
                                        class="my-3"
                                ></iframe>
                            @endif

                            <hr class="my-4">

                            <h5 class="mb-3">{{ __('Phone numbers') }}</h5>

                            @foreach($settings->phoneNumbers as $key => $phoneNumber)
                                <div class="phone-number-field-group">
                                    <div class="js--add-new-phone-row-wrapper d-flex align-items-center">
                                        <div class="form-group w-100">
                                            <input class="form-control phone-input @error('phone_number') is-invalid @enderror" type="text" name="phone_number[]" id="phone_number_{{ $phoneNumber->id }}" value="{{ old('phone_number', $phoneNumber->phone_number) }}" required>

                                            @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <button class="btn btn-light btn-icon mb-3 ml-3 js--add-new-phone-row" type="button">
                                            <i data-feather="plus"></i>
                                        </button>

                                        <button class="btn btn-danger btn-icon mb-3 ml-3 js--remove-new-phone-row remove-phone-input @if($key == 0) d-none @endif"
                                                type="button"
                                                data-id="{{ $phoneNumber->id }}"
                                                data-url="/admin/request/remove-phone-number"
                                                data-title="Are you sure you want to remove this number?"
                                                data-confirm-text="Delete"
                                                data-cancel-text="Cancel"
                                        >
                                            <i data-feather="minus"></i>
                                        </button>
                                    </div>

                                    @if($key == 0)
                                        <div class="custom-control custom-radio mb-3">
                                            <input class="custom-control-input" id="is_main_number_{{ $phoneNumber->id }}" type="radio" name="is_main_number[]" value="@if($phoneNumber->is_main_number == 1) 1 @else 0 @endif" @if($phoneNumber->is_main_number == 1) checked @endif>
                                            <label class="custom-control-label" for="is_main_number_{{ $phoneNumber->id }}">{{ __('Primary Number') }}</label>
                                        </div>
                                    @endif

                                </div>
                            @endforeach

                            <button class="btn btn-primary mt-3" type="submit">{{ __('Save') }}</button>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <!-- Payment methods -->
                    <div class="card card-header-actions mb-4">
                        <div class="card-header">
                            {{ __('Payment Methods') }}
                        </div>
                        <div class="card-body">
                            <!-- Payment method 1-->

                            @if (!empty($paymentGateways))
                                @foreach($paymentGateways as $key => $gateway)
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">

                                            <img src="{{ asset('storage/payment-gateways/'.$gateway->icon) }}" width="36" alt="{{ $gateway->name }}">

                                            <div class="ml-4">
                                                <div class="small">{{ $gateway->name }}</div>
                                                <div class="text-xs text-muted">
                                                    @if (!empty($gateway->deleted_at))
                                                        {{ __('Inactive') }}
                                                    @else
                                                        {{ __('Active') }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-4 small">
                                            @if (!empty($gateway->deleted_at))
                                                <div class="badge badge-danger mr-3">{{ __('Inactive') }}</div>
                                            @else
                                                <div class="badge badge-light mr-3">{{ __('Active') }}</div>
                                            @endif

                                            <a href="{{ url('admin/payment-gateways/'.$gateway->id.'/edit') }}">{{ __('Edit') }}</a>
                                            <button type="button"
                                                    class="btn btn-datatable btn-icon text-danger remove-page"
                                                    data-page-id="{{ $gateway->id }}"
                                                    data-url="{{ url('/admin/payment-gateways/destroy') }}"
                                                    data-title="Are you sure you want to disable this payment?"
                                                    data-confirm-text="Disable"
                                                    data-cancel-text="Cancel">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </div>
                                    </div>

                                    @if ($key == array_key_last((array) $paymentGateways))
                                        <hr />
                                    @endif
                                @endforeach
                            @endif

                        </div>
                    </div>

                    <!-- Site images -->
                    <div class="card mb-4">
                        <div class="card-header">{{ __('Logo') }}</div>
                        <div class="card-body">

                            <!-- Site logo -->
                            <div class="file-field">
                                <label for="site-logo"></label>
                                <div class="images">

                                    @if(!empty($settings->logo))
                                        <div class="img">
                                            <img src="{{ asset('storage/site/'.$settings->logo) }}" alt="{{ $settings->title }}">
                                            <span class="remove-pic result_file"
                                                  data-file-id="{{ $settings->id }}"
                                                  data-file-url="/admin/request/remove-site-logo-image"
                                                  data-title="Are you sure you want to remove this file?"
                                                  data-confirm-text="Delete"
                                                  data-cancel-text="Cancel"><i class="fal fa-times"></i></span>
                                        </div>

                                        <div class="pic" style="display: none;">
                                            <span style="font-size: 1.25rem;">Logo</span>
                                            <input type="file" name="logo" accept="image/*" class="file-uploader d-none form-control @error('logo') is-invalid @enderror" id="site-logo">

                                            @error('logo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    @else
                                        <div class="pic">
                                            <span style="font-size: 1.25rem;">Logo</span>
                                            <input type="file" name="logo" accept="image/*" class="file-uploader d-none form-control @error('logo') is-invalid @enderror" id="site-logo">

                                            @error('logo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- .end Site logo -->

                            <!-- Site logo sm -->
                            <div class="file-field">
                                <label for="site-logo_sm"></label>
                                <div class="images">

                                    @if(!empty($settings->logo_sm))
                                        <div class="img">
                                            <img src="{{ asset('storage/site/'.$settings->logo_sm) }}" alt="{{ $settings->title }}">
                                            <span class="remove-pic result_file"
                                                  data-file-id="{{ $settings->id }}"
                                                  data-file-url="/admin/request/remove-site-logo-sm-image"
                                                  data-title="Are you sure you want to remove this file?"
                                                  data-confirm-text="Delete"
                                                  data-cancel-text="Cancel"><i class="fal fa-times"></i></span>
                                        </div>

                                        <div class="pic" style="display: none;">
                                            <span style="font-size: 1.25rem;">Logo SM</span>
                                            <input type="file" name="logo_sm" accept="image/*" class="file-uploader d-none form-control @error('logo_sm') is-invalid @enderror" id="site-logo_sm">

                                            @error('logo_sm')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    @else
                                        <div class="pic">
                                            <span style="font-size: 1.25rem;">Logo SM</span>
                                            <input type="file" name="logo_sm" accept="image/*" class="file-uploader d-none form-control @error('logo_sm') is-invalid @enderror" id="site-logo_sm">

                                            @error('logo_sm')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- .end Site logo sm -->

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
    <script src="{{ asset('admin/js/admin.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/pages.js') }}" type="text/javascript" defer></script>
@endpush
