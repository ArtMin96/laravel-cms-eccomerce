@extends('layouts.app')

@section('seo')
    @include('partials.Seo', ['seo' => $page->seo])
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">

    <style>
        .dropdown-image.dropdown-image-empty {
            background-size: cover !important;
        }
    </style>
@endpush

@section('content')

@endsection
