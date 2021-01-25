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
                            <div class="page-header-icon"><i data-feather="book"></i></div>
                            {{ __('admin.Blog') }}
                        </h1>
                    </div>

                    <div class="col-12 col-xl-auto mb-3">
                        <a href="{{ url('admin/blog/create') }}" class="btn btn-sm btn-primary" type="button">{{ __('admin.create_blog') }}</a>
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
                            <th>{{ __('admin.Title') }}</th>
                            <th>{{ __('admin.Description') }}</th>
                            <th>{{ __('admin.Created date') }}</th>
                            <th>{{ __('admin.Updated date') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>{{ __('admin.Title') }}</th>
                            <th>{{ __('admin.Description') }}</th>
                            <th>{{ __('admin.Created date') }}</th>
                            <th>{{ __('admin.Updated date') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td>{{ $blog->title }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($blog->description, 80, '...') }}</td>
                                <td>{{ date('Y-m-d H:i', strtotime($blog->created_at)) }}</td>
                                <td>{{ date('Y-m-d H:i', strtotime($blog->updated_at)) }}</td>
                                <td>
                                    <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('admin/blog/'.$blog->id.'/edit') }}">
                                        <i data-feather="edit-3"></i>
                                    </a>
                                    <button type="submit"
                                            class="btn btn-datatable btn-icon text-danger remove-page"
                                            data-page-id="{{ $blog->id }}"
                                            data-url="{{ url('/admin/blog/destroy') }}"
                                            data-title="{{ __('admin.remove_confirmation') }}"
                                            data-confirm-text="{{ __('admin.Delete') }}"
                                            data-cancel-text="{{ __('admin.Cancel') }}">
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
