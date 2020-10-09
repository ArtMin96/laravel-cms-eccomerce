@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
@endpush

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
                    <div class="g-page-description-text-box">
                        <h2 class="font-size-4 ">The Translation Company You Need</h2>
                        <div class="g-page-description-text">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap intoLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap intoLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 rectangle-image-box">
                    <div class="g-page-description-image-box">
                        <img src="./images/description/description-46.png" alt="gaudeamus" class="g-page-description-image">
                    </div>
                </div>
            </div>
        </section>

        @if(!empty($translationServices))
            <section class="py-4">
                <h2 class="font-size-1 blue-color text-center mb-3">Professional Translation Services for Any Industry</h2>
                <div class="w-50 w-md-50 mx-auto mb-5">
                    <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, ea fuga fugit maxime odio harum incidunt libero mollitia nam natus, non obcaecati officiis quaerat reiciendis repudiandae sapiente sed soluta temporibus.</p>
                </div>
                <div class="row">

                    @foreach($translationServices as $translationService)
                        <div class="col-md-6 col-lg-3">
                            <div class="dropdown g-dropdown mb-4">
                                <div class="dropdown-toggle" type="button" id="g-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="dropdown-image-box">

                                        @if (!empty($translationService->icon))
                                            <span class="dropdown-image" style="background-image: url({{ asset('storage/translation-services/'.$translationService->icon) }})"></span>
                                        @else
                                            <span class="dropdown-image" style="background-image: url({{ asset('/images/svg/service.svg') }})"></span>
                                        @endif

                                    </div>
                                    <span class="dropdown-text">{{ $translationService->title }}</span>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="g-dropdown-1">
                                    <div>{{ $translationService->description }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="w-50 w-md-50 mx-auto mt-5">
                    <p class="text-center">Don’t see your industry listed? <button class="g-link g-link-2 green-color">Chat now</button> to find out which of our professional translation services will reach your target clients.</p>
                </div>
            </section>
        @endif

        <section class="py-4">
            <h2 class="font-size-1 blue-color text-center mb-3">All Our Professional Translation Services</h2>
            <div class="w-50 w-md-50 mx-auto mb-5">
                <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. non obcaecati officiis quaerat reiciendis repudiandae sapiente sed soluta temporibus.</p>
            </div>
            <div class="menu-cards">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center mb-5 d-flex flex-sm-row flex-column justify-content-center">
                            <button class="g-btn g-btn-simple font-size-4 dot-point menu-cards-btn" data-target="translator">Translator</button>
                            <button class="g-btn g-btn-simple font-size-4 dot-point menu-cards-btn" data-target="interpreting">Interpreting</button>
                            <button class="g-btn g-btn-simple font-size-4 dot-point menu-cards-btn" data-target="transcription">Transcription</button>
                            <button class="g-btn g-btn-simple font-size-4 dot-point menu-cards-btn" data-target="localization">Localization</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="g-card-simple g-card-simple-2 g-card-wrap" data-role="translator">
                            <span class="g-card-simple-image" style="background-image: url(./images/services/service-1.png)"></span>
                            <div class="font-weight-bold font-size-5 text-center">Translator</div>
                            <p class="g-card-simple-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores, officiis quos rem reprehenderit sint, sunt tempore, ut! Commodi est harum ipsa nesciunt quod totam unde? Dolorum enim ipsum libero maiores nobis quasi ratione repudiandae?</p>
                            <div class="mt-3 font-size-5 font-weight-bold text-center">
                                <a href="./pages/forms/translation.html" class="g-link g-link-2">Request a translation</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="g-card-simple g-card-simple-2 g-card-wrap" data-role="interpreting">
                            <span class="g-card-simple-image" style="background-image: url(./images/services/service-2.png)"></span>
                            <div class="font-weight-bold font-size-5 text-center">Interpreting</div>
                            <p class="g-card-simple-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores, officiis quos rem reprehenderit sint, sunt tempore, ut! Commodi est harum ipsa nesciunt quod totam unde? Dolorum enim ipsum libero maiores nobis quasi ratione repudiandae?</p>
                            <div class="mt-3 font-size-5 font-weight-bold text-center">
                                <a href="./pages/forms/interpretation.html" class="g-link g-link-2">Book an interpreter</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="g-card-simple g-card-simple-2 g-card-wrap" data-role="transcription">
                            <span class="g-card-simple-image" style="background-image: url(./images/services/service-3.png)"></span>
                            <div class="font-weight-bold font-size-5 text-center">Transcription</div>
                            <p class="g-card-simple-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores, officiis quos rem reprehenderit sint, sunt tempore, ut! Commodi est harum ipsa nesciunt quod totam unde? Dolorum enim ipsum libero maiores nobis quasi ratione repudiandae?</p>
                            <div class="mt-3 font-size-5 font-weight-bold text-center">
                                <a href="./pages/forms/event.html" class="g-link g-link-2">Request a transcription</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="g-card-simple g-card-simple-2 g-card-wrap" data-role="localization">
                            <span class="g-card-simple-image" style="background-image: url(./images/services/service-4.png)"></span>
                            <div class="font-weight-bold font-size-5 text-center">Localization</div>
                            <p class="g-card-simple-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores, officiis quos rem reprehenderit sint, sunt tempore, ut! Commodi est harum ipsa nesciunt quod totam unde? Dolorum enim ipsum libero maiores nobis quasi ratione repudiandae?</p>
                            <div class="mt-3 font-size-5 font-weight-bold text-center">
                                <a href="./pages/forms/localization.html" class="g-link g-link-2">Get a Quote</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="g-page-description-1">
            <div class="row">
                <div class="col-md-6 rectangle-image-box">
                    <div class="g-page-description-image-box">
                        <img src="./images/description/description-47.png" alt="gaudeamus" class="g-page-description-image">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="g-page-description-text-box">
                        <h2 class="font-size-4 ">What is lorem ipsum</h2>
                        <div class="g-page-description-text">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap intoLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap intoLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                        <div class="g-description-list-btn-box text-left">
                            <a href="#" class="g-btn g-btn-green text-uppercase">Get your ready translation</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="g-page-description-1">
            <div class="row">
                <div class="col-md-6">
                    <div class="g-page-description-text-box">
                        <h2 class="font-size-4 ">What is lorem ipsum</h2>
                        <div class="g-page-description-text">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap intoLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap intoLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                        <div class="g-description-list-btn-box">
                            <a href="#" class="g-btn g-btn-green text-uppercase">Translate yourself</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 rectangle-image-box">
                    <div class="g-page-description-image-box">
                        <img src="./images/description/description-48.png" alt="gaudeamus" class="g-page-description-image">
                    </div>
                </div>
            </div>
        </section>

        <section class="g-page-description-1">
            <div class="row">
                <div class="col-md-6 rectangle-image-box">
                    <div class="g-page-description-image-box">
                        <img src="./images/description/description-49.png" alt="gaudeamus" class="g-page-description-image">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="g-page-description-text-box">
                        <h2 class="font-size-4 ">What is lorem ipsum</h2>
                        <div class="g-page-description-text">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap intoLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap intoLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                        <div class="g-description-list-btn-box text-left">
                            <a href="#" class="g-link g-link-3 text-uppercase">CONNECT ME TO CUSTOMER SUPPORT</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="g-page-description-1">
            <div class="row">
                <div class="col-md-6">
                    <div class="g-page-description-text-box">
                        <h2 class="font-size-4">The Fastest Translation company</h2>
                        <div class="g-page-description-text">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap intoLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap intoLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                        <div class="g-description-list-btn-box">
                            <a href="#" class="g-link g-link-3 text-uppercase">TRANSLATE MY DOCUMENTS NOW!</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 rectangle-image-box">
                    <div class="g-page-description-image-box">
                        <img src="./images/description/description-50.png" alt="gaudeamus" class="g-page-description-image">
                    </div>
                </div>
            </div>
        </section>

        <section class="py-4">
            <h2 class="font-size-1 blue-color text-center mb-3">Thorough 5-Step Quality Control</h2>
            <div class=" w-50 w-md-50 mx-auto mb-5">
                <p class="text-center">You will never suffer from mistranslation. We promise. We follow a strict 5-step review process to ensure that your translations are 100% accurate, every time. We so firmly stand behind this, that we give you our lifetime guarantee.</p>
            </div>
            <div class="g-steps-box">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="g-step-item">
                            <img src="./images/steps/step-1.png" class="g-step-image" alt="gaudeamus">
                            <span class="mb-2">Professional Translations</span>
                            <span>Your document receives perfect translating & accurate formatting, while preserving the meaning.</span>
                        </div>
                    </div>
                    <div class="col-lg-3 g-step-line-col">
                        <div class="g-step-line g-step-line-1"></div>
                    </div>
                    <div class="col-lg-2">
                        <div class="g-step-item">
                            <img src="./images/steps/step-2.png" class="g-step-image" alt="gaudeamus">
                            <span class="mb-2">Meticulous Proofreading</span>
                            <span>Your Proofreader checks verbiage, syntax, spelling, & grammar</span>
                        </div>
                    </div>
                    <div class="col-lg-3 g-step-line-col">
                        <div class="g-step-line g-step-line-1"></div>
                    </div>
                    <div class="col-lg-2">
                        <div class="g-step-item">
                            <img src="./images/steps/step-3.png" class="g-step-image" alt="gaudeamus">
                            <span class="mb-2">Precision Editing</span>
                            <span>Your Editor compares the original & translated documents to assure symmetry.</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 g-step-line-col">
                        <div class="g-step-line-2-box">
                            <div class="g-step-line-2 g-step-line-2-1"></div>
                            <div class="g-step-line-2 g-step-line-2-2"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-lg-2">
                        <div class="g-step-item">
                            <img src="./images/steps/step-4.png" class="g-step-image" alt="gaudeamus">
                            <span class="mb-2">Project Manager Review</span>
                            <span>Your Project Manager reviews the final copy to guarantee it meets your requests.</span>
                        </div>
                    </div>
                    <div class="col-lg-3 g-step-line-col">
                        <div class="g-step-line g-step-line-1"></div>
                    </div>
                    <div class="col-lg-2">
                        <div class="g-step-item">
                            <img src="./images/steps/step-5.png" class="g-step-image" alt="gaudeamus">
                            <span class="mb-2">Speedy Delivery</span>
                            <span>Your approval is the last step. Once approved, your final documents are delivered instantly.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-5">
                <p class="text-center">The best part… if you ever find an error months, or even years down the road, just come back to us. We will fix it. We promise you 100% accurate professional translation services every time, no matter what. That’s our lifetime guarantee.</p>
                <div class="g-collapse">
                    <div class="text-center">
                        <button class="g-link g-link-2 green-color" type="button" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1">
                            See more
                        </button>
                    </div>
                    <div class="collapse" id="collapse-1">
                        <div class="card card-body">
                            <div class="text-center">
                                <p>riatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.</p>
                                <div class="py-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="#" class="g-btn g-btn-img w-100 mb-4">
                <span>
                    <img src="./images/steps/step-btn-1.png" alt="gaudeamus"><span></span>
                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#" class="g-btn g-btn-img w-100 mb-4">
                <span>
                    <img src="./images/steps/step-btn-2.png" alt="gaudeamus"><span></span>
                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#" class="g-btn g-btn-img w-100 mb-4">
                <span>
                    <img src="./images/steps/step-btn-3.png" alt="gaudeamus"><span></span>
                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#" class="g-btn g-btn-img w-100 mb-4">
                <span>
                    <img src="./images/steps/step-btn-2.png" alt="gaudeamus"><span></span>
                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#" class="g-btn g-btn-img w-100 mb-4">
                <span>
                    <img src="./images/steps/step-btn-1.png" alt="gaudeamus"><span></span>
                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#" class="g-btn g-btn-img w-100 mb-4">
                <span>
                    <img src="./images/steps/step-btn-3.png" alt="gaudeamus"><span></span>
                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="pb-4 pt-0">
            <div class="g-scroll-nums-box g-card-wrap">
                <div class="g-scroll-nums-list">
                    <div class="g-scroll-num-item">
                        <div class="font-weight-bold font-size-1 blue-color"><span class="g-scroll-num" data-num="5000">0</span> <span>+</span></div>
                        <div class="g-scroll-text">Happy Clients</div>
                    </div>
                    <div class="g-scroll-num-item">
                        <div class="font-weight-bold font-size-1 blue-color"><span class="g-scroll-num" data-num="30000">0</span> <span>+</span></div>
                        <div class="g-scroll-text">Proffesional Linguists</div>
                    </div>
                    <div class="g-scroll-num-item">
                        <div class="font-weight-bold font-size-1 blue-color"><span class="g-scroll-num" data-num="116">0</span> <span>+</span></div>
                        <div class="g-scroll-text">Languages</div>
                    </div>
                    <div class="g-scroll-num-item">
                        <div class="font-weight-bold font-size-1 blue-color"><span class="g-scroll-num" data-num="1500000">0</span> <span>Million+</span></div>
                        <div class="g-scroll-text">Words Translated</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="g-message-btn-box"><a href="#" class="g-message-btn"></a></div>

@endsection

@push('script')
    <script src="{{ asset('js/owl.carousel.min.js') }}" defer></script>
@endpush
