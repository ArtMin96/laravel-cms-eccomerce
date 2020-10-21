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
                                <p class="blue-color font-weight-bold font-size-5">{{ __('forms.Reset Password') }}</p>

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row">

                            <div class="col-12">
                                <div class="form-group g-form-group">
                                    <label for="email">{{ __('forms.E-mail') }}</label>
                                    <input id="email" type="email" class="form-control g-form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group g-form-group">
                                    <label for="password">{{ __('forms.Password') }}</label>
                                    <input id="password" type="password" class="form-control g-form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group g-form-group">
                                    <label for="password-confirm">{{ __('forms.Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control g-form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group g-form-group mb-3">
                                    <div class="text-center">
                                        <button type="submit" class="g-btn g-btn-blue g-btn-round text-uppercase">{{ __('forms.Reset Password') }}</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
            <div class="col-lg-2 d-none d-md-block"></div>
        </div>
    </div>

@endsection
