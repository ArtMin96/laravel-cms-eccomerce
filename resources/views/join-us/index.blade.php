@extends('layouts.app')

@section('content')

    <section class="g-home-banner">
        <div class="g-banner-bg" style="background-image: url({{ asset('storage/banner/'.$page->banners->image)  }});"></div>
        <div class="g-banner-content">
            <div class="g-banner-description">
                <h1 class="g-title">{{ $page->banners->title }}</h1>
                <p class="font-size-2 g-banner-text">{{ $page->banners->description }}</p>
            </div>
            <div class="g-banner-buttons mt-5">
                <a href="../user/document_shop.html" class="g-btn g-btn-green">Get your ready translation</a>
                <a href="../user/document_templates.html" class="g-btn g-btn-green">Translate yourself</a>
            </div>
        </div>

        <div class="g-soc-box">
            <ul class="g-soc-wrap">
                <li class="g-soc-item g-soc-location"><a href="https://www.google.com/maps/place/42+Tumanyan+St,+Yerevan,+Armenia/@40.187054,44.511407,18z/data=!4m5!3m4!1s0x406abd1db99c3ce1:0x8663c432835d1d5c!8m2!3d40.1870543!4d44.5114073?hl=en" target="_blank" class="g-soc-link"><span>42 Tumanyan, 0002 Yerevan, Armenia</span></a></li>
                <li class="g-soc-item g-soc-phone"><a href="tel:+37411561678" class="g-soc-link"><span>+374 11 56 16 78</span></a></li>
                <li class="g-soc-item g-soc-mail"><a href="mailto:info@gaudeamus.com" class="g-soc-link"><span>info@gaudeamus.com</span></a></li>
            </ul>
        </div>
    </section>

    <div class="container">
        <section class="g-page-description-1">
            <div class="row">
                <div class="col-md-6">
                    <div class="g-page-description-image-box">
                        <img src="../../images/description/description-51.png" alt="gaudeamus" class="g-page-description-image">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="g-page-description-text-box">
                        <h2 class="font-size-4">What is lorem ipsum</h2>
                        <div class="g-page-description-text">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap intoLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap intoLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="mb-5">
                <h2 class="g-title text-center">Apply for job</h2>
            </div>
            <div class="row">
                <div class="col-lg-2 d-none d-md-block"></div>
                <div class="col-lg-8">
                    <div class="row">

                        @if(session()->has('message'))
                            <div class="col-12">
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            </div>
                        @endif

                        <div class="col-12">

                            @foreach($jobs as $job)

                                <div class="g-collapse mb-5">
                                    <div class="g-tag-btn">
                                        <div class="g-tag-btn-body">
                                            <div class="g-tag-btn-text">{{ $job->title }}</div>
                                            <div class="g-tag-btn-button">
                                                <button class="g-btn g-btn-green g-btn-round" type="button" data-toggle="collapse" data-target="#collapse-{{ $job->id }}" aria-expanded="false" aria-controls="collapse-{{ $job->id }}">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse pt-4 border-top" id="collapse-{{ $job->id }}">
                                        <div class="card card-body p-0">

                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <form action="{{ route('join-us.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="job_id" value="{{ $job->id }}">

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group g-form-group">
                                                            <label for="name">{{ __('Name') }}</label>
                                                            <input type="text" class="form-control g-form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">

                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group g-form-group">
                                                            <label for="last-name">{{ __('Last name') }}</label>
                                                            <input type="text" class="form-control g-form-control @error('last_name') is-invalid @enderror" id="last-name" name="last_name" value="{{ old('last_name') }}">

                                                            @error('last_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group g-form-group">
                                                            <label for="phone">{{ __('Phone number') }}</label>
                                                            <input type="tel" class="form-control g-form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">

                                                            @error('phone')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group g-form-group">
                                                            <label for="email">{{ __('E-mail') }}</label>
                                                            <input type="text" class="form-control g-form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">

                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group g-form-group">
                                                            <label for="field_expertise">{{ __('Field of expertise') }}</label>
                                                            <select class="form-control g-form-control g-form-control-square selectpicker @error('field_expertise') is-invalid @enderror" id="field_expertise" name="field_expertise">
                                                                <option value="1">option 1</option>
                                                                <option value="2">option 2</option>
                                                            </select>

                                                            @error('field_expertise')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group g-form-group">
                                                            <label for="year_expertise">{{ __('Year of expertise') }}</label>
                                                            <input type="number" class="form-control g-form-control g-form-control-square @error('year_expertise') is-invalid @enderror" id="year_expertise" name="year_expertise" value="{{ old('year_expertise') }}">

                                                            @error('year_expertise')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group g-form-group">
                                                            <label for="translated_page_number">{{ __('Number of translated page') }}</label>
                                                            <input type="number" class="form-control g-form-control g-form-control-square @error('translated_page_number') is-invalid @enderror" id="translated_page_number" name="translated_page_number" value="{{ old('translated_page_number') }}">

                                                            @error('translated_page_number')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group g-form-group">
                                                            <label for="daily_translation_capacity">{{ __('Daily translation capacity') }}</label>
                                                            <input type="number" class="form-control g-form-control g-form-control-square @error('daily_translation_capacity') is-invalid @enderror" id="daily_translation_capacity" name="daily_translation_capacity" value="{{ old('daily_translation_capacity') }}">

                                                            @error('daily_translation_capacity')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <p class="text-center font-weight-bold font-size-5">Applying for Freelance translator or In-house translator</p>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="job-place-box">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="job-place-item text-center">
                                                                        <input type="radio" name="translator_type" value="0">
                                                                        <button class="g-btn g-btn-green-ol g-btn-round mb-3 job-place-btn" type="button">Freelance</button>
                                                                        <div class="g-form-group-sm">
                                                                            <input type="number" class="form-control g-form-control g-form-control-square job-place-input @error('translation_rate_per_page') is-invalid @enderror" placeholder="{{ __('Translation rate per page') }}" id="translation_rate_per_page" name="translation_rate_per_page" value="{{ old('translation_rate_per_page') }}" disabled>

                                                                            @error('translation_rate_per_page')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="job-place-item text-center">
                                                                        <input type="radio" name="translator_type" value="1">
                                                                        <button class="g-btn g-btn-green-ol g-btn-round mb-3 job-place-btn" type="button">In house</button>
                                                                        <div class="g-form-group-sm">
                                                                            <input type="number" class="form-control g-form-control g-form-control-square job-place-input @error('monthly_salary_expectation') is-invalid @enderror" placeholder="{{ __('Monthly salary expectation') }}" id="monthly_salary_expectation" name="monthly_salary_expectation" value="{{ old('monthly_salary_expectation') }}" disabled>

                                                                            @error('monthly_salary_expectation')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="text-center mt-4">
                                                            <label class="g-type-file g-type-file-1">
                                                                <input type="file" name="cv">Upload CV <i class="fas fa-upload"></i>
                                                            </label>

                                                            @error('cv')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="text-center mt-4">
                                                            <button type="submit" class="g-btn g-btn-green g-btn-round">Apply</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-2 d-none d-md-block"></div>
            </div>
        </section>
    </div>

    <div class="g-message-btn-box"><a href="#" class="g-message-btn"></a></div>

@endsection
