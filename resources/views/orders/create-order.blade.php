@extends('layouts.app')

@section('content')
    <div class="container">

        <x-profile-menu />

        <div class="row">
            <div class="col-lg-3">
                <x-profile-sidebar />
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <a href="{{ LaravelLocalization::localizeUrl('/translate-now') }}" class="g-btn g-btn-white font-weight-bold w-100 text-uppercase">{{ __('pages.TRANSLATE NOW') }}</a>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <a href="{{ LaravelLocalization::localizeUrl('/document-template') }}" class="g-btn g-btn-white font-weight-bold w-100 text-uppercase">{{ __('pages.Translate yourself') }}</a>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <a href="{{ LaravelLocalization::localizeUrl('/document-shop') }}" class="g-btn g-btn-white font-weight-bold w-100 text-uppercase">{{ __('pages.Document Online Shop') }}</a>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <a href="{{ LaravelLocalization::localizeUrl('/interpretation') }}" class="g-btn g-btn-white font-weight-bold w-100 text-uppercase">{{ __('pages.Book an interpreter') }}</a>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <a href="{{ LaravelLocalization::localizeUrl('/rent-equipment') }}" class="g-btn g-btn-white font-weight-bold w-100 text-uppercase">{{ __('pages.Rent equipment') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
