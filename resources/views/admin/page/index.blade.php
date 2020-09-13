@extends('admin.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="grid"></i></div>
                            {{ __('Pages') }}
                        </h1>
                    </div>

                    <div class="col-12 col-xl-auto mb-3">
                        <a href="{{ url('admin/page/create') }}" class="btn btn-sm btn-primary" type="button">{{ __('Create new page') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">Extended DataTables</div>
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Parent</th>
                                <th>Sort order</th>
                                <th>Status</th>
                                <th>Created date</th>
                                <th>Updated date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Parent</th>
                                <th>Sort order</th>
                                <th>Status</th>
                                <th>Created date</th>
                                <th>Updated date</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->name }}</td>
                                    <td>{{ $page->alias }}</td>
                                    <td>@if($parent = $page->page) {{ $parent->name }} @else - @endif</td>
                                    <td>{{ $page->sort_active }}</td>
                                    <td>@if(!empty($page->deleted_at)) ? <div class="badge badge-danger badge-pill">Inactive</div> @else <div class="badge badge-success badge-pill">Active</div> @endif</td>
                                    <td>{{ date('Y-m-d H:i', strtotime($page->created_at)) }}</td>
                                    <td>{{ date('Y-m-d H:i', strtotime($page->updated_at)) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark" id="dropdownMenuPageActions" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuPageActions">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <div class="dropdown-item-icon">
                                                        <i data-feather="edit-3"></i>
                                                    </div>
                                                    {{ __('Edit') }}
                                                </a><a class="dropdown-item" href="javascript:void(0);">
                                                    <div class="dropdown-item-icon">
                                                        <i data-feather="settings"></i>
                                                    </div>
                                                    Settings
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <div class="dropdown-item-icon">
                                                        <i data-feather="log-out"></i>
                                                    </div>
                                                    Logout
                                                </a>
                                            </div>
                                        </div>
                                        @if($parent = $page->page)
                                            <form action="{{ route('admin.page.destroy', $page->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                            </form>
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
@endpush
