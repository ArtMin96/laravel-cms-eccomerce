@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-2 d-none d-md-block"></div>
            <div class="col-lg-8">
                <div class="g-wrapper">

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3 text-center">
                                {{ __('auth.Verify Your Email Address') }}
                            </div>

                            <div class="mb-3">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('auth.A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                {{ __('auth.Before proceeding, please check your email for a verification link.') }}
                                {{ __('auth.If you did not receive the email') }},
                            </div>

                            <div class="mb-3">
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="g-btn g-link g-link-2 text-capitalize green-color p-0">{{ __('auth.click here to request another') }}</button>.
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>--}}

{{--                    <div class="card-body">--}}
{{--                        @if (session('resent'))--}}
{{--                            <div class="alert alert-success" role="alert">--}}
{{--                                {{ __('A fresh verification link has been sent to your email address.') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                        {{ __('Before proceeding, please check your email for a verification link.') }}--}}
{{--                        {{ __('If you did not receive the email') }},--}}
{{--                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">--}}
{{--                            @csrf--}}
{{--                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
