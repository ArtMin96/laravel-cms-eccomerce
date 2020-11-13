@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="g-title text-center my-5">Equipment rent</h2>
            </div>
        </div>
        <div class="g-wrapper">
            <form action="{{ route('rent-equipment.place.rent') }}" method="POST" role="form">
                @csrf

                <input type="hidden" name="person_type" value="{{ auth()->user()->person_type }}">
                <input type="hidden" name="product_id" value="{{ request()->route('id') }}">

                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="name">{{ __('forms.Name') }}</label>
                            <input type="text" class="form-control g-form-control @error('first_name') is-invalid @enderror" value="{{ auth()->user()->name }}" id="name" name="first_name" aria-describedby="nameHelp" required>

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="company">{{ __('forms.Company name') }}</label>
                            <input type="text" class="form-control g-form-control @error('company') is-invalid @enderror" value="@if(auth()->user()->person_type == 1) {{ auth()->user()->company }} @endif" id="company" name="company" aria-describedby="companyHelp">

                            @error('company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <div class="form-group g-form-group">
                                <label for="country">{{ __('forms.Country') }}</label>
                                <input type="text" class="form-control g-form-control @error('country') is-invalid @enderror" value="@if(!empty(auth()->user()->country)) {{ auth()->user()->country }} @endif" id="country" name="country" aria-describedby="countryHelp">

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="phone">{{ __('forms.Phone Number') }}</label>
                            <input type="text" class="form-control g-form-control @error('phone') is-invalid @enderror" value="@if(!empty(auth()->user()->phone)) {{ auth()->user()->phone }} @endif" id="phone" name="phone" aria-describedby="phoneHelp" required>

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="email">{{ __('forms.E-mail') }}</label>
                            <input type="text" class="form-control g-form-control @error('email') is-invalid @enderror" value="@if(!empty(auth()->user()->email)) {{ auth()->user()->email }} @endif" id="email" name="email" aria-describedby="emailHelp" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="event_day">{{ __('forms.Event day') }}</label>
                            <input type="date" class="form-control g-form-control @error('event_day') is-invalid @enderror" id="event_day" name="event_day" aria-describedby="event_dayHelp">

                            @error('event_day')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group g-form-group">
                            <label for="event_venue">{{ __('forms.Event venue') }}</label>
                            <input type="text" class="form-control g-form-control @error('event_venue') is-invalid @enderror" id="event_venue" name="event_venue" aria-describedby="event_venueHelp">

                            @error('event_venue')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group g-form-group mb-0 text-center">
                            <button type="submit" class="g-btn g-btn-blue g-btn-round text-uppercase">check order</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
