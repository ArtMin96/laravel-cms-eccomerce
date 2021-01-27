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
                        <div class="col-lg-12">
                            <div class="g-blog-item-main">
                                <img src="{{ asset('storage/blog/' . $blog->image) }}" class="g-blog-image-main" alt="{{ $blog->title }}">
                                <div class="g-blog-main-content">
                                    <p class="g-blog-main-description">
                                        <a href="{{ route('blog.detail', $blog->id) }}" class="g-link g-link-2">
                                            {{ $blog->title }}
                                        </a>
                                    </p>

                                    <span class="font-size-6">
                                        @if(empty($blog->short_description))
                                            {{ \Illuminate\Support\Str::limit($blog->description) }}
                                        @else
                                            {{ \Illuminate\Support\Str::limit($blog->short_description) }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6">
                            <div class="g-blog-item">
                                <figure>
                                    <img src="{{ asset('storage/blog/' . $blog->image) }}" class="g-blog-image img-fluid" alt="{{ $blog->title }}">
                                    <figcaption>
                                        <a href="{{ route('blog.detail', $blog->id) }}" class="g-link g-link-2 g-blog-link">
                                            {{ $blog->title }}
                                        </a>
                                    </figcaption>
                                </figure>

                                <p class="g-blog-description">
                                    @if(empty($blog->short_description))
                                        {{ \Illuminate\Support\Str::limit($blog->description, 200) }}
                                    @else
                                        {{ \Illuminate\Support\Str::limit($blog->short_description, 200) }}
                                    @endif
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
