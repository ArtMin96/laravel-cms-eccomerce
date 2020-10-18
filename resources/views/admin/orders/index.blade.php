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
                            <div class="page-header-icon"><i data-feather="clipboard"></i></div>
                            {{ __('admin.Orders') }}
                        </h1>
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
                                <th>{{ __('admin.Order Number') }}</th>
                                <th>{{ __('admin.Placed By') }}</th>
                                <th>{{ __('admin.Total Amount') }}</th>
                                <th>{{ __('admin.Items Qty') }}</th>
                                <th>{{ __('admin.Status') }}</th>
                                <th>{{ __('admin.Payment Status') }}</th>
                                <th>{{ __('admin.Created date') }}</th>
                                <th>{{ __('admin.Actions') }}</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>{{ __('admin.Order Number') }}</th>
                                <th>{{ __('admin.Placed By') }}</th>
                                <th>{{ __('admin.Total Amount') }}</th>
                                <th>{{ __('admin.Items Qty') }}</th>
                                <th>{{ __('admin.Status') }}</th>
                                <th>{{ __('admin.Payment Status') }}</th>
                                <th>{{ __('admin.Created date') }}</th>
                                <th>{{ __('admin.Actions') }}</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->user->name }} {{ $order->user->last_name }}</td>
                                    <td class="text-center">{{ $order->grand_total }} AMD</td>
                                    <td class="text-center">{{ $order->item_count }}</td>
                                    <td class="text-center">
                                        <span class="badge" style="background-color: {{ $order->orderStatus->color }}">{{ $order->orderStatus->name }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if ($order->payment_status == 1)
                                            <span class="badge badge-success">{{ __('admin.Paid') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('admin.Not paid') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $order->created_at->toFormattedDateString() }}</td>
                                    <td>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ route('admin.orders.show', $order->order_number) }}">
                                            <i data-feather="eye"></i>
                                        </a>
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
