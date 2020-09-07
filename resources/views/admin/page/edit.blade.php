@extends('admin.layouts.app')

@section('content')

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
                    <a class="nav-item nav-link active" id="wizard1-tab" href="#wizard1" data-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                        <div class="wizard-step-icon">1</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Page Details') }}</div>
                            <div class="wizard-step-text-details">{{ __('Basic details and information') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 2-->
                    <a class="nav-item nav-link" id="wizard2-tab" href="#wizard2" data-toggle="tab" role="tab" aria-controls="wizard2" aria-selected="true">
                        <div class="wizard-step-icon">2</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Page Content') }}</div>
                            <div class="wizard-step-text-details">{{ __('Page content details') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 3-->
                    <a class="nav-item nav-link" id="wizard3-tab" href="#wizard3" data-toggle="tab" role="tab" aria-controls="wizard3" aria-selected="true">
                        <div class="wizard-step-icon">3</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">{{ __('Banner') }}</div>
                            <div class="wizard-step-text-details">{{ __('Page banner details') }}</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 4-->
                    <a class="nav-item nav-link" id="wizard4-tab" href="#wizard4" data-toggle="tab" role="tab" aria-controls="wizard4" aria-selected="true">
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
                    <!-- Wizard tab pane item 1-->
                    <div class="tab-pane py-5 py-xl-10 fade show active" id="wizard1" role="tabpanel" aria-labelledby="wizard1-tab">
                        <div class="row justify-content-center">
                            <div class="col-xxl-6 col-xl-8">

                                <h3 class="text-primary">{{ __('Step') }} 1</h3>
                                <h5 class="card-title">{{ __('Enter page basic information') }}</h5>

                                <form action="{{ route('admin.page.update', $page->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <ul class="nav nav-tabs translatable-switcher mb-4">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="javascript:void(0);" id="english">EN</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="javascript:void(0);" id="russian">RU</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="javascript:void(0);" id="armenian">HY</a>
                                        </li>
                                    </ul>

                                    <div class="card-body p-0" id="english-form">
                                        <div class="form-group">
                                            <label class="required" for="en_name">{{ trans('Page name') }} (EN)</label>
                                            <input class="form-control @error('en_name') is-invalid @enderror" type="text" name="en_name" id="en_name" value="{{ old('en_name', $page->translate('en')->name) }}" required>

                                            @error('en_name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="card-body d-none p-0" id="russian-form">
                                        <div class="form-group">
                                            <label class="required" for="ru_name">{{ trans('Page name') }} (RU)</label>
                                            <input class="form-control @error('ru_name') is-invalid @enderror" type="text" name="ru_name" id="ru_name" value="{{ old('ru_name', $page->translate('ru')->name) }}" required>

                                            @error('ru_name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="card-body d-none p-0" id="armenian-form">
                                        <div class="form-group">
                                            <label class="required" for="hy_name">{{ trans('Page name') }} (HY)</label>
                                            <input class="form-control @error('hy_name') is-invalid @enderror" type="text" name="hy_name" id="hy_name" value="{{ old('hy_name', $page->translate('hy')->name) }}" required>

                                            @error('hy_name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="required" for="alias">{{ trans('Page URL') }}</label>
                                        <input class="form-control @error('alias') is-invalid @enderror" type="text" name="alias" id="alias" value="{{ old('alias', $page->alias) }}" required>

                                        @error('alias')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <label class="required" for="parent_id">{{ trans('Parent page') }}</label>
                                        <select class="form-control @error('parent_id') is-invalid @enderror" type="text" name="parent_id" id="parent_id">
                                            @if(!empty($pages))
                                                @foreach($pages as $pageOptions)
                                                    <option value="{{ $pageOptions->id }}" @if($page->parent_id == $pageOptions->id) selected @endif>{{ $pageOptions->translate(app()->getLocale())->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @error('parent_id')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <label class="required" for="sort_order">{{ trans('Page Sort') }}</label>
                                        <input class="form-control @error('sort_order') is-invalid @enderror" type="text" name="sort_order" id="sort_order" value="{{ old('sort_order', $page->sort_order) }}" required>

                                        @error('sort_order')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>

                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- Wizard tab pane item 2-->
                    <div class="tab-pane py-5 py-xl-10 fade" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                        <div class="row justify-content-center">
                            <div class="col-xxl-6 col-xl-8">
                                <h3 class="text-primary">Step 2</h3>
                                <h5 class="card-title">Enter your billing details</h5>
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="small mb-1" for="inputBillingName">Name on card</label>
                                            <input class="form-control" id="inputBillingName" type="text" placeholder="Enter the name as it appears on your card" value="Valerie Luna">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="small mb-1" for="inputBillingCCNumber">Card number</label>
                                            <input class="form-control" id="inputBillingCCNumber" type="text" placeholder="Enter your credit card number" value="4444 3333 2222 1111">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4 mb-4 mb-md-0">
                                            <label class="small mb-1" for="inputOrgName">Card expiry month</label>
                                            <input class="form-control" id="inputOrgName" type="text" placeholder="Enter expiry month" value="06">
                                        </div>
                                        <div class="form-group col-md-4 mb-4 mb-md-0">
                                            <label class="small mb-1" for="inputLocation">Card expiry year</label>
                                            <input class="form-control" id="inputLocation" type="text" placeholder="Enter expiry year" value="2024">
                                        </div>
                                        <div class="form-group col-md-4 mb-0">
                                            <label class="small mb-1" for="inputLocation">CVV Number</label>
                                            <input class="form-control" id="inputLocation" type="password" placeholder="Enter CVV number" value="111">
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-light" type="button">Previous</button>
                                        <button class="btn btn-primary" type="button">Next</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Wizard tab pane item 3-->
                    <div class="tab-pane py-5 py-xl-10 fade" id="wizard3" role="tabpanel" aria-labelledby="wizard3-tab">
                        <div class="row justify-content-center">
                            <div class="col-xxl-6 col-xl-8">
                                <h3 class="text-primary">Step 3</h3>
                                <h5 class="card-title">Choose when you want to receive email notifications</h5>
                                <form>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="checkAccountChanges" type="checkbox" checked="">
                                        <label class="custom-control-label" for="checkAccountChanges">Changes made to your account</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="checkAccountGroups" type="checkbox" checked="">
                                        <label class="custom-control-label" for="checkAccountGroups">Changes are made to groups you're part of</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="checkProductUpdates" type="checkbox" checked="">
                                        <label class="custom-control-label" for="checkProductUpdates">Product updates for products you've purchased or starred</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="checkProductNew" type="checkbox" checked="">
                                        <label class="custom-control-label" for="checkProductNew">Information on new products and services</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="checkPromotional" type="checkbox">
                                        <label class="custom-control-label" for="checkPromotional">Marketing and promotional offers</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="checkSecurity" type="checkbox" checked="" disabled="">
                                        <label class="custom-control-label" for="checkSecurity">Security alerts</label>
                                    </div>
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-light" type="button">Previous</button>
                                        <button class="btn btn-primary" type="button">Next</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Wizard tab pane item 4-->
                    <div class="tab-pane py-5 py-xl-10 fade" id="wizard4" role="tabpanel" aria-labelledby="wizard4-tab">
                        <div class="row justify-content-center">
                            <div class="col-xxl-6 col-xl-8">
                                <h3 class="text-primary">Step 4</h3>
                                <h5 class="card-title">Review the following information and submit</h5>
                                <div class="row small text-muted">
                                    <div class="col-sm-3 text-truncate"><em>Username:</em></div>
                                    <div class="col">username</div>
                                </div>
                                <div class="row small text-muted">
                                    <div class="col-sm-3 text-truncate"><em>Name:</em></div>
                                    <div class="col">Valerie Luna</div>
                                </div>
                                <div class="row small text-muted">
                                    <div class="col-sm-3 text-truncate"><em>Organization Name:</em></div>
                                    <div class="col">Start Bootstrap</div>
                                </div>
                                <div class="row small text-muted">
                                    <div class="col-sm-3 text-truncate"><em>Location:</em></div>
                                    <div class="col">San Francisco, CA</div>
                                </div>
                                <div class="row small text-muted">
                                    <div class="col-sm-3 text-truncate"><em>Email Address:</em></div>
                                    <div class="col">name@example.com</div>
                                </div>
                                <div class="row small text-muted">
                                    <div class="col-sm-3 text-truncate"><em>Phone Number:</em></div>
                                    <div class="col">555-123-4567</div>
                                </div>
                                <div class="row small text-muted">
                                    <div class="col-sm-3 text-truncate"><em>Birthday:</em></div>
                                    <div class="col">06/10/1988</div>
                                </div>
                                <div class="row small text-muted">
                                    <div class="col-sm-3 text-truncate"><em>Credit Card Number:</em></div>
                                    <div class="col">**** **** **** 1111</div>
                                </div>
                                <div class="row small text-muted">
                                    <div class="col-sm-3 text-truncate"><em>Credit Card Expiration:</em></div>
                                    <div class="col">06/2024</div>
                                </div>
                                <hr class="my-4">
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-light" type="button">Previous</button>
                                    <button class="btn btn-primary" type="button">Submit</button>
                                </div>
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
@endpush