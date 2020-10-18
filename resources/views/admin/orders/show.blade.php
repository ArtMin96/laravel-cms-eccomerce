@extends('admin.layouts.app')

@section('content')
    <!-- Main page content-->
    <div class="container mt-4">
        <!-- Invoice-->
        <div class="card invoice mb-4">
            <div class="card-header p-4 p-md-5 border-bottom-0 bg-gradient-primary-to-secondary text-white-50">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-lg-auto mb-5 mb-lg-0 text-center text-lg-left">
                        <!-- Invoice branding-->
                        <img class="invoice-brand-img rounded-circle mb-4" src="assets/img/logo-invoice.svg" alt />
                        <div class="h2 text-white mb-0">{{ $order->user->name }} {{ $order->user->last_name }}</div>
                        <a href="mailto:{{ $order->user->email }}" class="text-muted">{{ $order->user->email }}</a>
                    </div>
                    <div class="col-12 col-lg-auto text-center text-lg-right">

                        {{ __('admin.Address') }} - {{ $order->address }}
                        <br />
                        {{ __('admin.Phone number') }} - {{ $order->phone_number }}
                    </div>
                    <div class="col-12 col-lg-auto text-center text-lg-right">

                        {{ __('admin.Order Number') }} - #{{ $order->order_number }}
                        <br />
                        {{ __('admin.Total Amount') }} - {{ round($order->grand_total, 2) }}
                        <br />
                        {{ __('admin.Status') }} - {{ $order->orderStatus->name }}
                        <br />
                        {{ __('admin.Payment Method') }} - {{ $order->paymentGateway->name }}
                        <br />
                        {{ __('admin.Payment Status') }} -
                        @if ($order->payment_status == 1)
                            <span class="badge badge-success">{{ __('admin.Paid') }}</span>
                        @else
                            <span class="badge badge-danger">{{ __('admin.Not paid') }}</span>
                        @endif
                        <br />
                        {{ __('admin.Created date') }} -
                        {{ $order->created_at->toFormattedDateString() }}
                    </div>
                </div>
            </div>
            <div class="card-body p-4 p-md-5">
                <!-- Invoice table-->
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="border-bottom">
                            <tr class="small text-uppercase text-muted">
                                <th scope="col">{{ __('admin.Title') }}</th>
                                <th class="text-right" scope="col">{{ __('admin.Quantity') }}</th>
                                <th class="text-right" scope="col">{{ __('admin.Amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($order->items as $item)
                                <tr class="border-bottom">
                                    <td>
                                        <div class="font-weight-bold">{{ $item->product->title }}</div>
                                        <div class="small text-muted d-none d-md-block">
                                            @if(!empty($item->product->description)) {{ $item->product->quantity }} @else - @endif
                                        </div>
                                    </td>
                                    <td class="text-right font-weight-bold">{{ $item->quantity }}</td>
                                    <td class="text-right font-weight-bold">{{ round($item->price, 2) }} AMD</td>
                                </tr>
                            @endforeach

                            <!-- Invoice total-->
                            <tr>
                                <td class="text-right pb-0" colspan="2"><div class="text-uppercase small font-weight-700 text-muted">{{ __('admin.Total Amount') }}:</div></td>
                                <td class="text-right pb-0"><div class="h5 mb-0 font-weight-700 text-green">{{ round($order->grand_total, 2) }} AMD</div></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
