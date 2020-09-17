@extends('admin.layouts.app')

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

@endsection
