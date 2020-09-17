@extends('admin.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/css/file-field.css') }}">
@endpush

@section('content')

{{--    @dd($page->banners[0]->translate('en')->title)--}}

    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="arrow-right-circle"></i></div>
                            {{ __('Create new page') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-n10">
        <!-- Wizard card example with navigation-->
        <div class="card">
            <div class="card-header border-bottom">
                <!-- Wizard navigation-->
                <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab" role="tablist">
                    <!-- Wizard navigation item 1-->
                    <a class="nav-item nav-link" id="page-basics-tab" href="{{ url('admin/page/'.$seo->page_id.'/edit') }}">
                        <div class="wizard-step-icon">1</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Page Details') }}</div>
                            <div class="wizard-step-text-details">{{ __('Basic details and information') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 2-->
                    <a class="nav-item nav-link" id="page-content-tab" href="{{ url('admin/page-content/'.$seo->page->id.'/edit') }}">
                        <div class="wizard-step-icon">2</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Page Content') }}</div>
                            <div class="wizard-step-text-details">{{ __('Page content details') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 3-->
                    <a class="nav-item nav-link" id="banner-tab" href="{{ url('admin/banner/'.$seo->page->banners->id.'/edit') }}">
                        <div class="wizard-step-icon">3</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Banner') }}</div>
                            <div class="wizard-step-text-details">{{ __('Page banner details') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 4-->
                    <a class="nav-item nav-link active" id="seo-tab" href="{{ url('admin/seo/'.$seo->id.'/edit') }}">
                        <div class="wizard-step-icon">4</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('SEO') }}</div>
                            <div class="wizard-step-text-details">{{ __('Page SEO details') }}</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="cardTabContent">

                    <!-- Wizard tab pane item 3-->
                    <div class="tab-pane py-5 py-xl-5 fade show active" id="banner" role="tabpanel" aria-labelledby="banner-tab">
                        <div class="row justify-content-center">
                            <div class="col-xl-10">

                                <h3 class="text-primary">{{ __('Step') }} 4</h3>
                                <h5 class="card-title">{{ __('Page banner details') }}</h5>

                                <form action="{{ route('admin.seo.update', $seo->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Metas -->
                                    <div class="card">
                                        <div class="card-header">
                                            <ul class="nav nav-pills card-header-pills" id="cardPill" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="website-meta-pill" href="#website-metaPill" data-toggle="tab" role="tab" aria-controls="website-meta" aria-selected="false">Website meta tags</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="facebook-pill" href="#facebookPill" data-toggle="tab" role="tab" aria-controls="facebook" aria-selected="true">Facebook</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="twitter-pill" href="#twitterPill" data-toggle="tab" role="tab" aria-controls="twitter" aria-selected="true">Twitter</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="cardPillContent">
                                                <div class="tab-pane fade show active" id="website-metaPill" role="tabpanel" aria-labelledby="website-meta-pill">

                                                    <div class="form-group">
                                                        <label class="required" for="meta_title">{{ trans('Meta title') }}</label>
                                                        <input class="form-control @error('meta_title') is-invalid @enderror" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $seo->meta_title) }}">

                                                        @error('meta_title')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="required" for="meta_keywords">{{ trans('Meta keywords') }}</label>
                                                        <input class="form-control @error('meta_keywords') is-invalid @enderror" type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $seo->meta_keywords) }}">

                                                        @error('meta_keywords')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="required" for="meta_description">{{ trans('Meta description') }}</label>
                                                        <textarea class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description">
                                                            {{ old('meta_description', $seo->meta_description) }}
                                                        </textarea>

                                                        @error('meta_description')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                    <!-- Meta image -->
                                                    <div class="file-field">
                                                        <label for="seo-image"></label>
                                                        <div class="images">

                                                            @if(!empty($seo->meta_image))
                                                                <div class="img">
                                                                    <img src="{{ asset('storage/seo/'.$seo->meta_image)  }}" alt="{{ $seo->meta_title }}">
                                                                    <span class="remove-pic result_file"
                                                                          data-file-id="{{ $seo->id }}"
                                                                          data-file-url="/admin/request/remove-seo-meta-image"
                                                                          data-title="Are you sure you want to remove this file?"
                                                                          data-confirm-text="Delete"
                                                                          data-cancel-text="Cancel"><i class="fal fa-times"></i></span>
                                                                </div>

                                                                <div class="pic" style="display: none;">
                                                                    <span style="font-size: 1.25rem;">Upload</span>
                                                                    <input type="file" name="meta_image" accept="image/*" class="file-uploader d-none form-control @error('meta_image') is-invalid @enderror" id="meta-image">

                                                                    @error('meta_image')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            @else
                                                                <div class="pic">
                                                                    <span style="font-size: 1.25rem;">Upload Meta Image</span>
                                                                    <input type="file" name="meta_image" accept="image/*" class="file-uploader d-none form-control @error('meta_image') is-invalid @enderror" id="meta-image">

                                                                    @error('meta_image')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- .end Meta image -->

                                                </div>

                                                <div class="tab-pane fade" id="facebookPill" role="tabpanel" aria-labelledby="facebook-pill">

                                                    <div class="form-group">
                                                        <label class="required" for="og_title">{{ trans('OG title') }}</label>
                                                        <input class="form-control @error('og_title') is-invalid @enderror" type="text" name="og_title" id="og_title" value="website" readonly>

                                                        @error('og_title')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="required" for="og_url">{{ trans('OG url') }}</label>
                                                        <input class="form-control @error('og_url') is-invalid @enderror" type="text" name="og_url" id="og_url" value="{{ url('/').'/'.$seo->page->alias }}" readonly>

                                                        @error('og_title')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="required" for="og_site_name">{{ trans('OG site_name') }}</label>
                                                        <input class="form-control @error('og_site_name') is-invalid @enderror" type="text" name="og_site_name" id="og_site_name" value="Gaudeamus" readonly>

                                                        @error('og_site_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="required" for="og_description">{{ trans('OG description') }}</label>
                                                        <textarea class="form-control @error('og_description') is-invalid @enderror" name="og_description" id="og_description">
                                                            {{ old('og_description', $seo->og_description) }}
                                                        </textarea>

                                                        @error('og_description')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                    <!-- Meta image -->
                                                    <div class="file-field">
                                                        <label for="og-image"></label>
                                                        <div class="images">

                                                            @if(!empty($seo->og_image))
                                                                <div class="img">
                                                                    <img src="{{ asset('storage/seo/'.$seo->og_image)  }}" alt="{{ $seo->meta_title }}">
                                                                    <span class="remove-pic result_file"
                                                                          data-file-id="{{ $seo->id }}"
                                                                          data-file-url="/admin/request/remove-facebook-image"
                                                                          data-title="Are you sure you want to remove this file?"
                                                                          data-confirm-text="Delete"
                                                                          data-cancel-text="Cancel"><i class="fal fa-times"></i></span>
                                                                </div>

                                                                <div class="pic" style="display: none;">
                                                                    <span style="font-size: 1.25rem;">Upload OG Image</span>
                                                                    <input type="file" name="og_image" accept="image/*" class="file-uploader d-none form-control @error('og_image') is-invalid @enderror" id="og-image">

                                                                    @error('og_image')
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            @else
                                                                <div class="pic">
                                                                    <span style="font-size: 1.25rem;">Upload OG Image</span>
                                                                    <input type="file" name="og_image" accept="image/*" class="file-uploader d-none form-control @error('og_image') is-invalid @enderror" id="og-image">

                                                                    @error('og_image')
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- .end Meta image -->

                                                </div>

                                                <div class="tab-pane fade" id="twitterPill" role="tabpanel" aria-labelledby="twitter-pill">

                                                    <div class="form-group">
                                                        <label class="required" for="twitter_title">{{ trans('Twitter title') }}</label>
                                                        <input class="form-control @error('twitter_title') is-invalid @enderror" type="text" name="twitter_title" id="twitter_title" value="{{ old('twitter_title'), $seo->twitter_title }}">

                                                        @error('twitter_title')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="required" for="twitter_site">{{ trans('Twitter site') }}</label>
                                                        <input class="form-control @error('twitter_site') is-invalid @enderror" type="text" name="twitter_site" id="twitter_site" value="{{ old('twitter_site'), $seo->twitter_site }}">

                                                        @error('twitter_site')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="required" for="twitter_creator">{{ trans('Twitter creator') }}</label>
                                                        <input class="form-control @error('twitter_creator') is-invalid @enderror" type="text" name="twitter_creator" id="twitter_creator" value="{{ old('twitter_creator'), $seo->twitter_creator }}">

                                                        @error('twitter_creator')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="required" for="twitter_description">{{ trans('Twitter description') }}</label>
                                                        <textarea class="form-control @error('twitter_description') is-invalid @enderror" name="twitter_description" id="twitter_description">
                                                            {{ old('twitter_description', $seo->twitter_description) }}
                                                        </textarea>

                                                        @error('twitter_description')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                    <!-- Meta image -->
                                                    <div class="file-field">
                                                        <label for="twitter-image"></label>
                                                        <div class="images">

                                                            @if(!empty($seo->twitter_image))
                                                                <div class="img">
                                                                    <img src="{{ asset('storage/seo/'.$seo->twitter_image)  }}" alt="{{ $seo->meta_title }}">
                                                                    <span class="remove-pic result_file"
                                                                          data-file-id="{{ $seo->id }}"
                                                                          data-file-url="/admin/request/remove-twitter-image"
                                                                          data-title="Are you sure you want to remove this file?"
                                                                          data-confirm-text="Delete"
                                                                          data-cancel-text="Cancel"><i class="fal fa-times"></i></span>
                                                                </div>

                                                                <div class="pic" style="display: none;">
                                                                    <span style="font-size: 1.25rem;">Upload Twitter Image</span>
                                                                    <input type="file" name="twitter_image" accept="image/*" class="file-uploader d-none form-control @error('twitter_image') is-invalid @enderror" id="twitter-image">

                                                                    @error('twitter_image')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            @else
                                                                <div class="pic">
                                                                    <span style="font-size: 1.25rem;">Upload Twitter Image</span>
                                                                    <input type="file" name="twitter_image" accept="image/*" class="file-uploader d-none form-control @error('twitter_image') is-invalid @enderror" id="twitter-image">

                                                                    @error('twitter_image')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- .end Meta image -->

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- .end Metas -->

                                    <button type="submit" class="btn btn-primary mt-5">{{ __('Update') }}</button>

                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset('admin/js/switch-translatable.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/select2.min.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('admin/js/file-field.js') }}" type="text/javascript" defer></script>
@endpush
