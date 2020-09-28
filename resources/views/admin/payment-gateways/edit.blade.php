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
                            <div class="page-header-icon"><i data-feather="credit-card"></i></div>
                            {{ __('Payment Gateway') }} - {{ $paymentGateways->name }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container mt-4">

        <form action="{{ route('admin.payment-gateways.update', $paymentGateways->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <div class="row">

                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card">
                            <div class="card-header">{{ __('Payment gateway logo') }}</div>
                            <div class="card-body text-center">

                                <div class="images">
                                    @if(!empty($paymentGateways->icon))

                                        <!-- Profile picture image-->
                                        <div class="img">
                                            <img src="{{ asset('storage/payment-gateways/'.$paymentGateways->icon) }}" alt="{{ $paymentGateways->name }}">
                                            <span class="remove-pic result_file"
                                                  data-file-id="{{ $paymentGateways->id }}"
                                                  data-file-url="/admin/request/remove-payment-gateway-icon"
                                                  data-title="Are you sure you want to remove this file?"
                                                  data-confirm-text="Delete"
                                                  data-cancel-text="Cancel"><i class="fal fa-times"></i></span>
                                        </div>
    {{--                                    <img class="img-account-profile rounded-circle mb-2" src="{{ asset('storage/our-team/'.$credentials->image) }}" alt="{{ $credentials->name }}" />--}}
                                    @else
                                        <div class="pic">
                                            <span style="font-size: 1.25rem;">Upload</span>
                                            <input type="file" name="icon" accept="image/*" class="file-uploader d-none form-control @error('icon') is-invalid @enderror" id="banner-image">
                                        </div>
                                    @endif
                                </div>

                                <!-- Profile picture help block-->
                                @error('icon')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="small font-italic text-muted mb-4">{{ __('JPG or PNG no larger than 5 MB') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header">Payment details</div>

                            <div class="card-body">

                                <!-- Name translations -->
                                <div class="translatable-form">

                                    <div class="card-body p-0">
                                        <div class="form-group">
                                            <label class="required" for="name">{{ trans('Payment name') }}</label>
                                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name', $paymentGateways->name) }}">

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label class="required" for="public_key">{{ trans('Public Key') }}</label>
                                            <input class="form-control @error('public_key') is-invalid @enderror" type="text" name="public_key" id="public_key" value="{{ old('public_key', $paymentGateways->public_key) }}">

                                            @error('public_key')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label class="required" for="private_key">{{ trans('Private Key') }}</label>
                                            <input class="form-control @error('private_key') is-invalid @enderror" type="text" name="private_key" id="private_key" value="{{ old('private_key', $paymentGateways->private_key) }}">

                                            @error('private_key')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" name="deleted_at" id="deleted_at" value="1" {{ empty($paymentGateways->deleted_at) ? 'checked' : '' }} />
                                                <label class="custom-control-label" for="deleted_at">{{ __('Enabled') }}</label>
                                            </div>
                                        </div>

                                    </div>
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
