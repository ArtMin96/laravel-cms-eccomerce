@extends('admin.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
    <style>
        .dropdown-image {
            width: 50px;
            height: 50px;
            display: inline-block;
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #6E7511;
            border-radius: 5px;
        }
    </style>
@endpush

@section('content')

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="columns"></i></div>
                            {{ __('Translation Services') }}
                        </h1>
                    </div>

                    <div class="col-12 col-xl-auto mb-3">
                        <a href="{{ url('admin/translation-services/create') }}" class="btn btn-sm btn-primary" type="button">{{ __('Create service') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container">
        <div class="card mb-4">
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created date</th>
                            <th>Updated date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Icon</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created date</th>
                            <th>Updated date</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($translationServices as $translationService)
                            <tr>
                                <td>
                                    @if(!empty($translationService->icon))
                                        <div class="translation-service-image d-flex justify-content-center">
                                            <span class="dropdown-image" style="background-image: url({{ asset('storage/translation-services/'.$translationService->icon)  }})"></span>
                                        </div>
                                    @else
                                        <div class="translation-service-image d-flex justify-content-center">
                                            <span class="dropdown-image" style="background-image: url({{ asset('/images/svg/service.svg')  }})"></span>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $translationService->title }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($translationService->description, 80, '...') }}</td>
                                <td>@if(!empty($translationService->deleted_at)) <div class="badge badge-danger badge-pill">{{ __('Inactive') }}</div> @else <div class="badge badge-success badge-pill">{{ __('Active') }}</div> @endif</td>
                                <td>{{ date('Y-m-d H:i', strtotime($translationService->created_at)) }}</td>
                                <td>{{ date('Y-m-d H:i', strtotime($translationService->updated_at)) }}</td>
                                <td>
                                    <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('admin/translation-services/'.$translationService->id.'/edit') }}">
                                        <i data-feather="edit-3"></i>
                                    </a>
                                    <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('admin/translation-services/'.$translationService->id.'/duplicate') }}">
                                        <i data-feather="copy"></i>
                                    </a>
                                    @if(empty($translationService->deleted_at))
                                        <button type="submit"
                                                class="btn btn-datatable btn-icon text-danger remove-page"
                                                data-page-id="{{ $translationService->id }}"
                                                data-url="{{ LaravelLocalization::localizeUrl('/admin/translation-services/destroy') }}"
                                                data-title="Are you sure you want to remove this service?"
                                                data-confirm-text="Delete"
                                                data-cancel-text="Cancel">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    @else
                                        <button type="submit"
                                                class="btn btn-datatable btn-icon text-success rollback-page"
                                                data-page-id="{{ $translationService->id }}"
                                                data-url="{{ LaravelLocalization::localizeUrl('/admin/translation-services/rollback') }}"
                                                data-title="Are you sure you want to rollback this services?"
                                                data-confirm-text="Rollback"
                                                data-cancel-text="Cancel">
                                            <i data-feather="refresh-ccw"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/data-table.js') }}" defer></script>
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/pages.js') }}" defer></script>
@endpush
