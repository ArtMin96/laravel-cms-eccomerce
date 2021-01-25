@extends('layouts.app')

@section('seo')
    @include('partials.Seo', ['seo' => $page->seo])
@endsection

@section('content')

    <div class="container mt-5">
        <div class="row">
            @if(count($blogs) > 0)

                @foreach($blogs as $blog)

                    @if($blog->is_img_card == 1)
                        <div class="col-lg-8">
                            <div class="g-blog-item-main">
                                <img src="{{ asset('storage/blog/' . $blog->image) }}" class="g-blog-image-main" alt="{{ $blog->title }}">
                                <div class="g-blog-main-content">
                                    <a href="#" class="g-btn g-btn-green text-uppercase mb-2">{{ $blog->title }}</a>
                                    <p class="g-blog-main-description">{{ $blog->description }}</p>
                                </div>
                            </div>
                        </div>
                    @elseif($blog->iteration % 2 == 0)
                        <div class="col-lg-4">
                            <div class="g-blog-item">
                                <figure>
                                    <img src="{{ asset('storage/blog/' . $blog->image) }}" class="g-blog-image img-fluid" alt="{{ $blog->title }}">
                                    <figcaption><a href="#" class="g-link g-link-2 g-blog-link">{{ $blog->title }}</a></figcaption>
                                </figure>
                                <p class="g-blog-description">
                                    {{ $blog->description }}
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6">
                            <div class="g-blog-item">
                                <figure>
                                    <img src="{{ asset('storage/blog/' . $blog->image) }}" class="g-blog-image img-fluid" alt="{{ $blog->title }}">
                                    <figcaption><a href="#" class="g-link g-link-2 g-blog-link">{{ $blog->title }}</a></figcaption>
                                </figure>
                                <p class="g-blog-description">
                                    {{ $blog->description }}
                                </p>
                            </div>
                        </div>
                    @endif

                @endforeach
            @endif
        </div>
    </div>

    @if(!empty($blogs))

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {{ $blogs->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    @endif

@endsection
