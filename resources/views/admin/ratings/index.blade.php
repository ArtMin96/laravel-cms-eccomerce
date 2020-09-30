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
                            <div class="page-header-icon"><i data-feather="star"></i></div>
                            {{ __('Ratings') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container">

        <div class="row">

            @if (!empty($services))
                @foreach($services as $service)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <!-- Dashboard info widget 1-->
                        <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <div class="small font-weight-bold text-primary mb-1">{{ $service->title }}</div>
                                        <div class="h5">{{ App\Rating::avgRating($service->id) }}</div>
                                    </div>
                                    <div class="ml-2"><i class="fas fa-chart-pie fa-2x text-gray-200"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Comment') }}</th>
                                <th>{{ __('Allow share') }}</th>
                                <th>{{ __('Ratings') }}</th>
                                <th>{{ __('Created date') }}</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Comment') }}</th>
                                <th>{{ __('Allow share') }}</th>
                                <th>{{ __('Ratings') }}</th>
                                <th>{{ __('Created date') }}</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($ratings as $rating)
                                <tr>
                                    <td>{{ $rating->name }}</td>
                                    <td>
                                        <a href="mailto:{{ $rating->email }}">{{ $rating->email }}</a>
                                    </td>
                                    <td>{{ \Illuminate\Support\Str::limit($rating->comment, 80, '...') }}</td>
                                    <td>@if($rating->allow_share == 0) {{ __('No') }} @else {{ __('Yes') }} @endif</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            @if(!empty($rating->ratings))
                                                @foreach($rating->ratings as $ratings)
                                                    @if ($ratings->star != 0)
                                                        <div>
                                                            <span class="font-weight-bold text-dark">{{ $ratings->rateService->title }}: </span>
                                                            <span>{{ $ratings->star }}</span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ date('Y-m-d H:i', strtotime($rating->created_at)) }}</td>
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
