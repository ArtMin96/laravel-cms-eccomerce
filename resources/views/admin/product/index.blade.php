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
                            <div class="page-header-icon"><i data-feather="box"></i></div>
                            {{ __('Products') }} - {{ $saleType->name }}
                        </h1>
                    </div>

                    @if(request()->route('id') != 2)
                        <div class="col-12 col-xl-auto mb-3">
                            <a href="{{ url('admin/product/'. $saleType->id .'/create') }}" class="btn btn-sm btn-primary">{{ __('Create Product') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->

    @if (\Session::has('success'))
        <div class="container">
            <div class="alert alert-success alert-icon" role="alert">
                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="alert-icon-aside">
                    <i class="fas fa-check"></i>
                </div>
                <div class="alert-icon-content">
                    <h6 class="alert-heading">{{ __('admin.success') }}</h6>
                    {!! \Session::get('success') !!}
                </div>
            </div>
        </div>
    @endif

    @if (\Session::has('error'))
        <div class="container">
            <div class="alert alert-success alert-icon" role="alert">
                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="alert-icon-aside">
                    <i class="fas fa-times"></i>
                </div>
                <div class="alert-icon-content">
                    <h6 class="alert-heading">{{ __('admin.error') }}</h6>
                    {!! \Session::get('error') !!}
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="card mb-4">
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Created date') }}</th>
                                <th>{{ __('Updated date') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Created date') }}</th>
                                <th>{{ __('Updated date') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>@if(!empty($product->deleted_at)) <div class="badge badge-danger badge-pill">{{ __('Inactive') }}</div> @else <div class="badge badge-success badge-pill">{{ __('Active') }}</div> @endif</td>
                                    <td>{{ date('Y-m-d H:i', strtotime($product->created_at)) }}</td>
                                    <td>{{ date('Y-m-d H:i', strtotime($product->updated_at)) }}</td>
                                    <td>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('admin/product/'.$product->id.'/edit') }}">
                                            <i data-feather="edit-3"></i>
                                        </a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('admin/product/'.$product->id.'/duplicate') }}">
                                            <i data-feather="copy"></i>
                                        </a>
                                        @if(empty($product->deleted_at))
                                            <button type="submit"
                                                    class="btn btn-datatable btn-icon text-danger remove-page"
                                                    data-page-id="{{ $product->id }}"
                                                    data-url="{{ url('/admin/product/destroy') }}"
                                                    data-title="Are you sure you want to remove this product?"
                                                    data-confirm-text="Delete"
                                                    data-cancel-text="Cancel">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        @else
                                            <button type="submit"
                                                    class="btn btn-datatable btn-icon text-success rollback-page"
                                                    data-page-id="{{ $product->id }}"
                                                    data-url="{{ LaravelLocalization::localizeUrl('/admin/product/rollback') }}"
                                                    data-title="Are you sure you want to rollback this product?"
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
