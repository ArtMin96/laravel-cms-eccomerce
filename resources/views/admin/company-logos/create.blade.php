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
                            <div class="page-header-icon"><i data-feather="layers"></i></div>
                            {{ __('Create company logo') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container mt-4">

        <form action="{{ route('admin.company-logos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-header">{{ __('Company logo') }}</div>
                        <div class="card-body text-center">

                            <div class="images">
                                @if(!empty($companyLogos->icon))

                                    <div class="img">
                                        <img src="{{ asset('storage/company-logos/'.$companyLogos->image) }}" alt="Company Logo">
                                        <span class="remove-pic result_file"
                                              data-file-id="{{ $companyLogos->id }}"
                                              data-file-url="/admin/request/remove-company-logo-image"
                                              data-title="Are you sure you want to remove this file?"
                                              data-confirm-text="Delete"
                                              data-cancel-text="Cancel"><i class="fal fa-times"></i></span>
                                    </div>
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
                        <div class="card-header">Company Details</div>

                        <div class="card-body">

                            <div class="form-group">
                                <label class="required" for="url">{{ __('URL') }}</label>
                                <input class="form-control @error('url') is-invalid @enderror" type="text" name="url" id="url" value="{{ old('url') }}">

                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

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
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/file-field.js') }}" type="text/javascript" defer></script>
@endpush
