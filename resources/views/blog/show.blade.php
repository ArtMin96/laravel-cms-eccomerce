@extends('layouts.app')

@section('seo')
{{--    @include('partials.Seo', ['seo' => $page->seo])--}}
@endsection

@section('content')

    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <article>
                    <img src="{{ asset('storage/blog/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid w-100 mb-5">
                    <div class="post-content">
                        <h3>{{ $blog->title }}</h3>
                        <ul class="post-meta list-inline">
                            <li class="list-inline-item">
                                <i class="far fa-calendar"></i> {{ carbon($blog->created_at)->diffForHumans() }}
                            </li>
                        </ul>
                        <p>{{ $blog->description }} </p>
                    </div>
                </article>
                <!-- post article-->

            </div>
        </div>
    </div>

@endsection
