<div>
    <header id="home" class="g-navbar">
        <div class="g-top-navbar">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo/'.$logo) }}"  alt="{{ $title }}"/>
            </a>

            <div class="g-navbar-buttons">
                <a href="../forms.html" class="g-btn g-btn-green-ol">{{ __('pages.TRANSLATE NOW') }}</a>

                <!-- Authentication Links -->
                @guest
                    <div class="dropdown">
                        <button class="g-btn g-link-2" type="button" id="dropdownUserButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="far fa-user-circle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right g-navbar-buttons-drop" aria-labelledby="dropdownUsergButton">
                            <li><a class="dropdown-item" href="{{ route('login') }}" data-lang="en"><i class="fas fa-sign-in-alt"></i>{{ __('pages.Login') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}" data-lang="en"><i class="fas fa-user-plus"></i>{{ __('pages.Sign up') }}</a></li>
                        </ul>
                    </div>
                @else
                    <div class="dropdown">
                        <button class="g-btn g-link-2" type="button" id="dropdownUserButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="far fa-user-circle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right g-navbar-buttons-drop" aria-labelledby="dropdownUsergButton">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-sign-in-alt"></i> {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-in-alt"></i>{{ __('pages.Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
            @endguest
            <!-- .end Authentication Links -->

                <a href="../user/basket.html" class="g-btn g-link-2"><i class="fas fa-shopping-cart"></i></a>
                <div class="dropdown">
                    <button class="g-btn" type="button" id="dropdownLangButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="../../images/flag/{{ LaravelLocalization::getCurrentLocale() }}.png" class="g-lang-flag g-lang-flag-show" alt="flag">
                    </button>
                    <ul class="dropdown-menu lang-dropdown-menu dropdown-menu-right g-navbar-buttons-drop" aria-labelledby="dropdownLangButton">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a class="dropdown-item" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" data-lang="en" rel="alternate">
                                    <img src="../../images/flag/{{ $localeCode }}.png" class="g-lang-flag" alt="flag"> {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav justify-content-center flex-grow-1">
                    {{ wrapMenu(menuItems()) }}
                </ul>
            </div>
        </nav>

    </header>
</div>
