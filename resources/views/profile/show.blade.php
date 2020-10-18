@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="g-page-navigation g-page-navigation-user mt-5">
                    <div class="g-page-navigation-content">
                        <div class="g-page-navigation-title">{{ __('pages.Personal area') }}</div>
                        <ul class="g-page-navigation-list">
                            <li class="g-page-navigation-item g-page-navigation-active"><a href="#" class="g-page-navigation-link">Главная</a></li>
                            <li class="g-page-navigation-item"><a href="#" class="g-page-navigation-link">Личный кабинет</a></li>
                        </ul>
                    </div>
                    <div class="dropdown g-page-navigation-user-drop">
                        <div class="dropdown-toggle" id="dropdownNavigationUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="g-page-navigation-user-image" style="background-image: url(@if(!empty(Auth::user()->image)) {{ asset('storage/users/'.Auth::user()->image) }} @else {{ asset('images/users/default-profile-image.png') }} @endif"></span>
                            <span class="g-page-navigation-user-name">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</span>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownLangButton">
                            <li><a class="dropdown-item" href="{{ url('/profile/change-password') }}"><i class="fas fa-key"></i>{{ __('pages.Change password') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2 class="g-title mb-5">{{ __('pages.Personal data') }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="g-side-menu g-side-menu-1">
                    <div class="g-side-menu-title">text</div>
                    <ul class="g-side-menu-list">
                        <li class="g-side-menu-item side-menu-main-item"><a href="./personal.html" class="g-side-menu-link">Create New order</a></li>
                        <li class="g-side-menu-item"><a href="{{ route('orders.index') }}" class="g-side-menu-link">My orders</a></li>
                        <li class="g-side-menu-item"><a href="./online_shop.html" class="g-side-menu-link">Translate now</a></li>
                        <li class="g-side-menu-item"><a href="./translate_yourselfs.html" class="g-side-menu-link">Translate yourself</a></li>
                        <li class="g-side-menu-item"><a href="online_shop_history.html" class="g-side-menu-link">Documents online shop</a></li>
                        <li class="g-side-menu-item"><a href="./rent_equipment.html" class="g-side-menu-link">Rent equipment</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-12">
                        <div class="g-wrapper">
                            <form class="personal-data-form" method="POST" action="{{ route('profile.update', Auth::user()->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="personal-data-bar">
                                    <button class="personal-data-edit g-btn card-hidden-elem" type="button"><i class="fas fa-pencil-alt"></i></button>
                                    <div class="position-relative">
                                        <div class="personal-data-toggler"></div>
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="personal-image-box text-center mb-4">
                                                    <img src="@if(!empty(Auth::user()->image)) {{ asset('storage/users/'.Auth::user()->image) }} @else {{ asset('images/users/default-profile-image.png') }} @endif" class="personal-image">
                                                    <button class="personal-image-del g-btn p-0 @if(!empty(Auth::user()->image)) remove-pic result_file @endif" type="button"
                                                            data-file-id="{{ Auth::user()->id }}"
                                                            data-file-url="/{{ app()->getLocale() }}/front-request/remove-user-image"
                                                            data-title="Are you sure you want to remove this file?"
                                                            data-confirm-text="Delete"
                                                            data-cancel-text="Cancel"><i class="fas fa-times"></i></button>
                                                    <label class="g-type-file g-type-file-3 personal-image-label">
                                                        <input type="file" class="personal-image-input" name="image">
                                                        <i class="fas fa-plus"></i>
                                                    </label>
                                                </div>
                                            </div>

                                            @error('image')
                                                <div class="col-12 mb-5 text-center">
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                </div>
                                            @enderror

                                            <div class="col-md-6">
                                                <div class="form-group g-form-group-sm">
                                                    <label for="name" class="personal-label">{{ __('forms.Name') }}</label>
                                                    <input type="text" class="form-control g-form-control-striped @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', Auth::user()->name) }}">

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group g-form-group-sm">
                                                    <label for="last-name" class="personal-label">{{ __('forms.Last Name') }}</label>
                                                    <input type="text" class="form-control g-form-control-striped @error('last_name') is-invalid @enderror" name="last_name" id="last-name" value="{{ old('last_name', Auth::user()->last_name) }}">

                                                    @error('last_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group g-form-group-sm">
                                                    <div>
                                                        <label class="d-block mb-2">{{ __('forms.Gender') }}</label>
                                                        <label class="g-radio label-row"><input type="radio" name="gender" value="0" @if(Auth::user()->gender == 0) checked @endif><span>{{ __('forms.Male') }}</span></label>
                                                        <label class="g-radio label-row ml-3"><input type="radio" name="gender" value="1" @if(Auth::user()->gender == 1) checked @endif><span>{{ __('forms.Female') }}</span></label>

                                                        @error('gender')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group g-form-group-sm">
                                                    <label for="country" class="personal-label">{{ __('forms.Country') }}</label>
                                                    <select class="form-control g-form-control-striped selectpicker" id="country" name="country">
                                                        <option value="" selected>{{ __('forms.Select country') }}</option>

                                                        @if(!empty($countries))
                                                            @foreach($countries as $country)
                                                                <option value="{{ $country->id }}" @if (Auth::user()->country == $country->id) selected @endif>{{ ucfirst($country->name) }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group g-form-group-sm">
                                                    <label for="city" class="personal-label">{{ __('forms.City') }}</label>
                                                    <select class="form-control g-form-control-striped selectpicker" id="city" name="city" data-live-search="true">

                                                        @if (!empty($user->city))
                                                            <option value="" selected>{{ __('forms.Select city') }}</option>

                                                            @if(!empty($cities))
                                                                @foreach($cities as $city)
                                                                    <option value="{{ $city->id }}" @if (Auth::user()->city == $city->id) selected @endif>{{ ucfirst($city->name) }}</option>
                                                                @endforeach
                                                            @endif
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group g-form-group-sm">
                                                    <label for="address" class="personal-label">{{ __('forms.Address') }}</label>
                                                    <input type="text" class="form-control g-form-control-striped @error('address') is-invalid @enderror" name="address" id="address" value="{{ old('address', Auth::user()->address) }}">

                                                    @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group g-form-group-sm">
                                                    <label for="company" class="personal-label">{{ __('forms.Company') }}</label>
                                                    <input type="text" class="form-control g-form-control-striped @error('company') is-invalid @enderror" name="company" id="company" value="{{ old('company', Auth::user()->company) }}">

                                                    @error('company')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group g-form-group-sm">
                                                    <label for="phone" class="personal-label">{{ __('forms.Phone') }}</label>
                                                    <input type="text" class="form-control g-form-control-striped @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone', phone(Auth::user()->phone, 'AM')) }}">

                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group g-form-group-sm">
                                                    <label for="email" class="personal-label">{{ __('forms.E-mail') }}</label>
                                                    <input type="email" class="form-control g-form-control-striped @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', Auth::user()->email) }}">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 personal-data-btn-col">
                                                <div class="text-center mt-3">
                                                    <button class="personal-data-cancel g-btn g-btn-blue-ol g-btn-round mr-3 mb-2" type="button">{{ __('pages.Cancel') }}</button>
                                                    <button class="personal-data-save g-btn g-btn-blue g-btn-round mb-2" type="submit">{{ __('pages.Save Changes') }}</button>
                                                </div>
                                            </div>
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

@endsection

@push('script')
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/file-field.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('js/requests.js') }}" type="text/javascript" defer></script>
@endpush
