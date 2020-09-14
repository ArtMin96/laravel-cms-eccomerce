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
                                <a href="{{ route('login') }}" class="g-btn g-link g-link-2 text-capitalize green-color">{{ __('Login') }}</a>
                                <a href="{{ route('register') }}" class="g-btn g-link g-link-2 text-capitalize">{{ __('Sign Up') }}</a>
                            </div>
                        </div>
                    </div>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row">

                            <div class="col-12">
                                <div class="form-group g-form-group">
                                    <label for="email">{{ __('Username / E-mail') }}</label>
                                    <input type="text" class="form-control g-form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group g-form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input type="password" class="form-control g-form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group g-form-group text-center mb-3">

                                    <label class="g-checkbox" for="remember">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span>{{ __('Remember Me') }}</span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group g-form-group mb-3">
                                    <div class="text-center">
                                        <button type="submit" class="g-btn g-btn-blue g-btn-round text-uppercase">{{ __('Login') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    @if (Route::has('password.request'))
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <a href="{{ route('password.request') }}" class="g-link g-link-2 font-weight-bold" type="button">{{ __('Forgot Your Password?') }}</a>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            <div class="col-lg-2 d-none d-md-block"></div>
        </div>
    </div>
@endsection
