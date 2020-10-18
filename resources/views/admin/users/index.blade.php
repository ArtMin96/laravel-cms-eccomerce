@extends('admin.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/switchery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/toastr.min.css') }}">
@endpush

@section('content')

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="users"></i></div>
                            {{ __('admin.Customers') }}
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
                                <th>{{ __('admin.Full name') }}</th>
                                <th>{{ __('admin.Email') }}</th>
                                <th>{{ __('admin.Status') }}</th>
                                <th>{{ __('admin.Created date') }}</th>
                                <th>{{ __('admin.Actions') }}</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>{{ __('admin.Full name') }}</th>
                                <th>{{ __('admin.Email') }}</th>
                                <th>{{ __('admin.Status') }}</th>
                                <th>{{ __('admin.Created date') }}</th>
                                <th>{{ __('admin.Actions') }}</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }} {{ $user->last_name }}</td>
                                    <td>
                                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                    </td>
                                    <td>
                                        <input type="checkbox" data-id="{{ $user->id }}" name="status" class="js-switch" {{ $user->status == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ !empty($user->created_at) ? $user->created_at->diffForHumans() : '-' }}</td>
                                    <td>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('admin/users/'.$user->id.'/edit') }}">
                                            <i data-feather="edit-3"></i>
                                        </a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('admin/users/'.$user->id.'/show') }}">
                                            <i data-feather="eye"></i>
                                        </a>
                                        <button type="submit"
                                                class="btn btn-datatable btn-icon text-danger remove-page"
                                                data-page-id="{{ $user->id }}"
                                                data-url="{{ url('/admin/users/destroy') }}"
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
    <script src="{{ asset('admin/js/switchery.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/toastr.min.js') }}" defer></script>

    <script>

        window.addEventListener('load', function () {
            let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

            elems.forEach(function(html) {
                let switchery = new Switchery(html,  { size: 'small' });
            });

            $('.js-switch').change(function () {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let userId = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('admin.users.update.status') }}',
                    data: {'status': status, 'user_id': userId},
                    success: function (data) {
                        console.log(data.message);
                        toastr.options.closeButton = true;
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.options.closeDuration = 100;
                        toastr.success(data.message);
                    }
                });
            });
        });

    </script>
@endpush
