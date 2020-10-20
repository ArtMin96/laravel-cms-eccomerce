@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="g-wrapper">

            <div class="row">
                <div class="col-12">
                    <div class="mb-3 text-center">
                        <a href="{{ route('login') }}" class="g-btn g-link g-link-2 text-capitalize">{{ __('pages.Login') }}</a>
                        <a href="{{ route('register') }}" class="g-btn g-link g-link-2 text-capitalize green-color">{{ __('pages.Sign Up') }}</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="g-list-group">
                        <div class="row">
                            <div class="col-12">
                                <div class="list-group flex-column justify-content-center flex-sm-row mb-2" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action g-btn g-btn-white mx-3 mb-3" id="list-1-list" data-toggle="list" href="#list-1" role="tab" aria-controls="home">{{ __('pages.Physical person') }}</a>
                                    <a class="list-group-item list-group-item-action g-btn g-btn-white mx-3 mb-3" id="list-2-list" data-toggle="list" href="#list-2" role="tab" aria-controls="profile">{{ __('pages.Legal person') }}</a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="list-1" role="tabpanel" aria-labelledby="list-1-list">
                                        <form class="needs-validation" novalidate method="POST" action="{{ route('register') }}">
                                            @csrf

                                            <input type="hidden" name="person_type" value="0">

                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <div class="form-group g-form-group">
                                                        <label for="name">{{ __('forms.Name') }}</label>
                                                        <input type="text" class="form-control g-form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group g-form-group">
                                                        <label for="last_name">{{ __('forms.Last Name') }}</label>
                                                        <input type="text" class="form-control g-form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                                        @error('last_name')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group g-form-group">
                                                        <label for="email">{{ __('forms.E-mail') }}</label>
                                                        <input type="text" class="form-control g-form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group g-form-group">
                                                        <label for="username">{{ __('forms.Username') }}</label>
                                                        <input type="text" class="form-control g-form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required autocomplete="username">

                                                        @error('username')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group g-form-group">
                                                        <label for="password">{{ __('forms.Password') }}</label>
                                                        <input type="password" class="form-control g-form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" required autocomplete="password">

                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group g-form-group">
                                                        <label for="password-confirm">{{ __('forms.Confirm Password') }}</label>
                                                        <input type="password" class="form-control g-form-control" id="password-confirm" name="password_confirmation" required autocomplete="new-password">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group g-form-group mb-0 text-center">
                                                        <button type="submit" class="g-btn g-btn-blue g-btn-round text-uppercase">{{ __('pages.Sign Up') }}</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="list-2" role="tabpanel" aria-labelledby="list-2-list">
                                        <form class="needs-validation" novalidate method="POST" action="{{ route('register') }}">
                                            @csrf

                                            <input type="hidden" name="person_type" value="1">

                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <div class="form-group g-form-group">
                                                        <label for="company">{{ __('forms.Company name') }}</label>
                                                        <input type="text" class="form-control g-form-control @error('company') is-invalid @enderror" id="company" name="company" value="{{ old('company') }}" required autocomplete="company">

                                                        @error('company')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group g-form-group">
                                                        <label for="email">{{ __('forms.E-mail') }}</label>
                                                        <input type="text" class="form-control g-form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group g-form-group">
                                                        <label for="phone">{{ __('forms.Phone') }}</label>
                                                        <input type="text" class="form-control g-form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                                        @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group g-form-group">
                                                        <label for="address">{{ __('forms.Address') }}</label>
                                                        <input type="text" class="form-control g-form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required autocomplete="address">

                                                        @error('address')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group g-form-group">
                                                        <label for="contact_person">{{ __('forms.Contact person') }}</label>
                                                        <input type="text" class="form-control g-form-control @error('contact_person') is-invalid @enderror" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" required autocomplete="contact_person">

                                                        @error('contact_person')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group g-form-group">
                                                        <label for="tax_code">{{ __('forms.Tax code') }}</label>
                                                        <input type="text" class="form-control g-form-control @error('tax_code') is-invalid @enderror" id="tax_code" name="tax_code" value="{{ old('tax_code') }}" required autocomplete="tax_code">

                                                        @error('tax_code')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group g-form-group">
                                                        <label for="password">{{ __('forms.Password') }}</label>
                                                        <input type="password" class="form-control g-form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" required autocomplete="password">

                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group g-form-group">
                                                        <label for="password-confirm">{{ __('forms.Confirm Password') }}</label>
                                                        <input type="password" class="form-control g-form-control" id="password-confirm" name="password_confirmation" required autocomplete="new-password">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group g-form-group mb-0 text-center">
                                                        <button type="submit" class="g-btn g-btn-blue g-btn-round text-uppercase">{{ __('pages.Sign Up') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
