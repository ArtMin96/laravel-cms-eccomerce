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
                                <p class="blue-color font-weight-bold font-size-5">{{ __('pages.Change password') }}</p>
                            </div>
                        </div>
                    </div>

                    @if(session()->has('message'))
                        <div class="col-12">
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    @endif

                    <form method="POST" action="{{ route('profile.update.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group g-form-group">
                                    <label for="password">{{ __('forms.Current password') }}</label>
                                    <input type="password" class="form-control g-form-control @error('password') is-invalid @enderror" name="password" id="password" required>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group g-form-group">
                                    <label for="new-password-input">{{ __('forms.New password') }}</label>
                                    <input type="password" class="form-control g-form-control @error('new_password') is-invalid @enderror" name="new_password" id="new-password-input" required>

                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group g-form-group">
                                    <label for="confirm-password-input">{{ __('forms.Confirm password') }}</label>
                                    <input type="password" class="form-control g-form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" id="new_password_confirmation" required>

                                    @error('new_password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group g-form-group text-center mb-0">
                                    <button class="g-btn g-btn-blue g-btn-round text-uppercase" type="submit">{{ __('pages.Save Changes') }}</button>
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
