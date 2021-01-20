<div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h3 class="text-primary">{{ __('Step') }} 2 - {{ $page->name }}</h3>
            <h5 class="card-title">{{ __('Page content details') }}</h5>
        </div>

        @if($page->page_number == \App\Page::Home)
            <div class="col-sm-12 col-md-6 text-right">
                <button wire:click.prevent="add()" class="btn btn-blue btn-icon">
                    <i data-feather="plus"></i>
                </button>
                <button type="button" class="btn btn-pink btn-icon mr-2">
                    <i data-feather="trash-2"></i>
                </button>
            </div>
        @endif
    </div>

    <form wire:submit.prevent="updatePageContent">
        @csrf

        @for($i = 0; $i < count($inputs); $i++)
            <div class="card card-header-actions mx-auto mb-5">
                <div class="p-3">

                    <input type="hidden" wire:model.lazy="inputs.{{ $i }}.pageId">

                    <div class="row">
                        <div class="col-sm-12 col-md-7">
                            <!-- Title translations -->
                            <div class="translatable-form">
                                <ul class="nav nav-tabs translatable-switcher mb-4">
                                    @foreach(config('app.locales') as $key => $locale)
                                        <li class="nav-item">
                                            <a class="nav-link locale-{{ $locale }} switch-{{ $locale }}
                                            @if($key == 0) active @endif
                                            @error('inputs.' . $i . '.pageTitle_' . $locale) text-danger @enderror
                                            @error('inputs.' . $i . '.pageDescription_' . $locale) text-danger @enderror" href="javascript:void(0);" data-locale="{{ $locale }}">{{ \Illuminate\Support\Str::upper($locale) }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                @foreach(config('app.locales') as $key => $locale)
                                    <div class="card-body switch-translatable-fields p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">
                                        <div class="form-group">
                                            <label class="required">{{ trans('Page content title') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                            <input class="form-control @error('inputs.' . $i . '.pageTitle_' . $locale) is-invalid @enderror" type="text" wire:model.lazy="inputs.{{ $i }}.pageTitle_{{ $locale }}">

                                            @error('inputs.' . $i . '.pageTitle_' . $locale)
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label class="required">{{ trans('Page content description') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                            <input class="form-control @error('inputs.' . $i . '.pageDescription_' . $locale) is-invalid @enderror" type="text" wire:model.lazy="inputs.{{ $i }}.pageDescription_{{ $locale }}">

                                            @error('inputs.' . $i . '.pageDescription_' . $locale)
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- .end Title translations -->

                            <hr />

                            <!-- Button types -->
                            <div class="form-group">
                                <label class="required">{{ __('Button type') }}</label>
                                <select class="form-control" wire:model="inputs.{{ $i }}.buttonType">
                                    <option value="">{{ __('Select button type') }}</option>
                                    <option value="0">{{ __('Basic') }}</option>
                                    <option value="1">{{ __('Filled') }}</option>
                                </select>
                            </div>
                            <!-- .end Button types -->

                            <!-- Link -->
                            <div class="form-group">
                                <label class="required" for="url">{{ __('URL') }}</label>
                                <input class="form-control @error('inputs.' . $i . '.url') is-invalid @enderror" type="text" wire:model.lazy="inputs.{{ $i }}.url">

                                @error('inputs.' . $i . '.url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <!-- .end Link -->

                            {{-- Link title --}}
                            <div class="translatable-form">
                                <ul class="nav nav-tabs translatable-switcher mb-4">
                                    @foreach(config('app.locales') as $key => $locale)
                                        <li class="nav-item">
                                            <a class="nav-link locale-{{ $locale }} switch-{{ $locale }}
                                            @if($key == 0) active @endif
                                            @error('inputs.' . $i . '.buttonText_' . $locale) text-danger @enderror" href="javascript:void(0);" data-locale="{{ $locale }}">{{ \Illuminate\Support\Str::upper($locale) }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                @foreach(config('app.locales') as $key => $locale)
                                    <div class="card-body switch-translatable-fields p-0 d-none {{ $locale }}-form @if($key == 0) d-block @endif">
                                        <div class="form-group">
                                            <label class="required">{{ trans('Button title') }} ({{ \Illuminate\Support\Str::upper($locale) }})</label>
                                            <input class="form-control @error('inputs.' . $i . '.buttonText_' . $locale) is-invalid @enderror" type="text" wire:model.lazy="inputs.{{ $i }}.buttonText_{{ $locale }}">

                                            @error('inputs.' . $i . '.buttonText_' . $locale)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- .end Link title --}}

                        </div>

                        <div class="col-sm-12 col-md-5">
                            <!-- Banner image -->
                            <div class="file-field">
                                <label for="page-content-image"></label>
                                <div class="images">

                                    @if($image)
                                        <img src="{{ $image->temporaryUrl() }}">
                                    @endif

                                    @if(!empty($inputs[0]['image']))
                                        <div class="img">
                                            <img src="{{ asset('storage/page-content/' . $inputs[0]['image']) }}" alt="{{ $inputs[0]['pageTitle_en'] }}">
                                            <span class="result_file"
                                                  wire:click.prevent="removeImage({{ $inputs[0]['pageId'] }})"><i class="fal fa-times"></i></span>
                                        </div>

                                        <div class="pic" style="display: none;">
                                            <span style="font-size: 1.25rem;">Upload</span>
                                            <input type="file" wire:model="inputs.{{ $i }}.image" accept="image/*" class="file-uploader d-none form-control @error('inputs.' . $i . '.image') is-invalid @enderror" id="page-content-image">
                                        </div>
                                    @else
                                        <div class="pic">
                                            <span style="font-size: 1.25rem;">Upload</span>
                                            <input type="file" wire:model="inputs.{{ $i }}.image" accept="image/*" class="file-uploader d-none form-control @error('inputs.' . $i . '.image') is-invalid @enderror" id="page-content-image">
                                        </div>
                                    @endif
                                </div>

                                @error('inputs.' . $i . '.image')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- .end Banner image -->
                        </div>
                    </div>

                </div>
            </div>
        @endfor

        <button wire:loading.attr="disabled" wire:target="updatePageContent" class="btn btn-primary mt-4">{{ __('Update') }}</button>

    </form>
</div>
