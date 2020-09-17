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
                            <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                            {{ __('Customer info') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container mt-4">

        <form action="{{ route('admin.customers.update', $customers->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-xl-6 offset-xl-3">
                    <!-- Profile picture card-->
                    <div class="card">
                        <div class="card-header">{{ __('Customer picture') }}</div>
                        <div class="card-body text-center">

                            <div class="images">
                            @if(!empty($customers->image))

                                <!-- Profile picture image-->
                                    <div class="img">
                                        <img src="{{ asset('storage/customers/'.$customers->image) }}" alt="Customer">
                                        <span class="remove-pic result_file"
                                              data-file-id="{{ $customers->id }}"
                                              data-file-url="/admin/request/remove-customers-image"
                                              data-title="Are you sure you want to remove this file?"
                                              data-confirm-text="Delete"
                                              data-cancel-text="Cancel"><i class="fal fa-times"></i></span>
                                    </div>
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
