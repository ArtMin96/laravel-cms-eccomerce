@extends('admin.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
@endpush

@section('content')

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="file"></i></div>
                            {{ __('Credentials') }}
                        </h1>
                    </div>

                    <div class="col-12 col-xl-auto mb-3">
                        <a href="{{ url('admin/credentials/create') }}" class="btn btn-sm btn-primary" type="button">{{ __('Create credential') }}</a>
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
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created date</th>
                            <th>Updated date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created date</th>
                            <th>Updated date</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($credentials as $credential)
                            <tr>
                                <td>{{ $credential->name }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($credential->description, 80, '...') }}</td>
                                <td>@if(!empty($credential->deleted_at)) ? <div class="badge badge-danger badge-pill">{{ __('Inactive') }}</div> @else <div class="badge badge-success badge-pill">{{ __('Active') }}</div> @endif</td>
                                <td>{{ date('Y-m-d H:i', strtotime($credential->created_at)) }}</td>
                                <td>{{ date('Y-m-d H:i', strtotime($credential->updated_at)) }}</td>
                                <td>
                                    <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('admin/our-team/'.$credential->id.'/edit') }}">
                                        <i data-feather="edit-3"></i>
                                    </a>
                                    <button type="submit"
                                            class="btn btn-datatable btn-icon text-danger remove-page"
                                            data-page-id="{{ $credential->id }}"
                                            data-url="{{ url('/admin/credentials/destroy') }}"
                                            data-title="Are you sure you want to remove this team member?"
                                            data-confirm-text="Delete"
                                            data-cancel-text="Cancel">
                                        <i data-feather="trash-2"></i>
                                    </button>
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
