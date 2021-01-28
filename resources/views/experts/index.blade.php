@extends('layouts.app')

@section('seo')
    @include('partials.Seo', ['seo' => $page->seo])
@endsection

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3">
                <div class="g-side-menu g-side-menu-3">
                    <div class="g-side-menu-title">Text</div>
                    <ul class="g-side-menu-list">
                        <li class="g-side-menu-item"><a href="{{ route('rent-equipment') }}" class="g-side-menu-link">Equipments</a></li>
                        <li class="g-side-menu-item g-side-menu-active"><a href="{{ route('experts.index') }}" class="g-side-menu-link">Experts</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="g-wrapper">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group g-form-group">
                                    <label for="name">{{ __('forms.Name') }}</label>
                                    <input type="text" class="form-control g-form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" aria-describedby="surnameHelp" required>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group g-form-group">
                                    <label for="last_name">{{ __('forms.Surname') }}</label>
                                    <input type="text" class="form-control g-form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" aria-describedby="surnameHelp" required>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group g-form-group">
                                    <label for="company-name">{{ __('forms.Company name') }}</label>
                                    <input type="text" class="form-control g-form-control @error('company_name') is-invalid @enderror" name="company_name" id="company-name" value="{{ old('company_name') }}" aria-describedby="surnameHelp" required>

                                    @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group g-form-group">
                                    <label for="phone">{{ __('forms.Phone Number') }}</label>
                                    <input type="tel" class="form-control g-form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}" required aria-describedby="phoneHelp">

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
                                    <input type="email" class="form-control g-form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" aria-describedby="mailHelp" required>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6"></div>
                            <div class="col-lg-6">
                                <div class="form-group g-form-group">
                                    <label for="interpretation-method">{{ __('forms.Interpretation method') }}</label>
                                    <select class="form-control g-form-control selectpicker @error('interpretation_method') is-invalid @enderror" name="interpretation_method" id="interpretation-method" aria-describedby="sourceLanguageHelp" required>
                                        @if(!empty($interpretationMethod))
                                            @foreach($interpretationMethod as $method)
                                                <option value="{{ $method->id }}">{{ $method->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @error('interpretation_method')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group g-form-group">
                                    <label for="field-interpretation-select">Field of interpretation</label>
                                    <select class="form-control g-form-control selectpicker" id="field-interpretation-select" aria-describedby="fieldInterpretationHelp" required>
                                        <option value="">option 1</option>
                                        <option value="">option 2</option>
                                    </select>
                                    <span class="valid-feedback">success</span>
                                    <span class="invalid-feedback">please enter correct value</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <span>Date of interpretation</span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group g-form-group-sm">
                                                            <div class="d-flex align-items-center">
                                                                <label for="date-interpretation-from-input" class="duration-day-label">from</label>
                                                                <input type="date" class="form-control g-form-control g-form-control-sm" id="date-interpretation-from-input" aria-describedby="dateInterpretationFromHelp" required>
                                                                <span class="valid-feedback">success</span>
                                                                <span class="invalid-feedback">please enter correct value</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group g-form-group-sm">
                                                            <div class="d-flex align-items-center">
                                                                <label for="date-interpretation-to-input" class="duration-day-label">to</label>
                                                                <input type="date" class="form-control g-form-control g-form-control-sm" id="date-interpretation-to-input" aria-describedby="dateInterpretationToHelp" required>
                                                                <span class="valid-feedback">success</span>
                                                                <span class="invalid-feedback">please enter correct value</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <span>Duration</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="duration-form-box">
                                            <div class="duration-form-rows-list">
                                                <div class="duration-form-row row">
                                                    <div class="col-md-6">
                                                        <div class="form-group g-form-group-sm">
                                                            <div class="d-flex align-items-center">
                                                                <label for="duration-1-input" class="duration-day-label">Day<span class="duration-form-day-count ml-1">1</span></label>
                                                                <input type="date" class="form-control g-form-control g-form-control-sm" id="duration-1-input" aria-describedby="dateInterpretationFromHelp">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group g-form-group-sm duration-responsive-col">
                                                            <select class="form-control g-form-control g-form-control-sm selectpicker" id="duration-1-select" aria-describedby="fieldInterpretationHelp">
                                                                <option value="full day">Full day</option>
                                                                <option value="half day">Half day</option>
                                                                <option value="hour">Hour</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button class="duration-form-add g-btn light-color p-0 mb-3" type="button"><i class="fas fa-plus-circle"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group g-form-group">
                                    <label for="source-language">{{ __('forms.Source Language') }}</label>
                                    <select class="form-control g-form-control selectpicker @error('source_language') is-invalid @enderror" name="source_language" id="source-language" aria-describedby="sourceLanguageHelp" required>
                                        @if(!empty($languages))
                                            @foreach($languages as $language)
                                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @error('source_language')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group g-form-group">
                                    <label for="translate-language">{{ __('forms.Target Language') }}</label>
                                    <select class="form-control g-form-control selectpicker @error('target_language') is-invalid @enderror" name="target_language" id="translate-language" aria-describedby="translateLanguageHelp" required>
                                        @if(!empty($languages))
                                            @foreach($languages as $language)
                                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @error('target_language')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-center">
                                    <p class="font-size-4">Special Notes</p>
                                    <p>Please provide additional details if needed</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group g-form-group">
                                    <label for="note-textarea">Note</label>
                                    <textarea rows="4" class="form-control g-form-control" id="note-textarea" aria-describedby="noteHelp"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group g-form-group mb-0 text-center">
                                    <button class="g-btn g-btn-blue g-btn-round text-capitalize">submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
