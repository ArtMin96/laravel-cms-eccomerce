<div class="row">
    <div class="col-12">
        <div class="g-page-navigation g-page-navigation-user mt-5">
            <div class="g-page-navigation-content">
                <div class="g-page-navigation-title">{{ __('pages.Personal area') }}</div>
                <ul class="g-page-navigation-list">
                    <li class="g-page-navigation-item g-page-navigation-active"><a href="#" class="g-page-navigation-link">Главная</a></li>
                    <li class="g-page-navigation-item"><a href="#" class="g-page-navigation-link">Личный кабинет</a></li>
                </ul>
            </div>
            <div class="dropdown g-page-navigation-user-drop">
                <div class="dropdown-toggle" id="dropdownNavigationUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="g-page-navigation-user-image" style="background-image: url(@if(!empty(Auth::user()->image)) {{ asset('storage/users/'.Auth::user()->image) }} @else {{ asset('images/users/default-profile-image.png') }} @endif"></span>
                    <span class="g-page-navigation-user-name">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</span>
                </div>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownLangButton">
                    <li><a class="dropdown-item" href="{{ url('/profile/change-password') }}"><i class="fas fa-key"></i>{{ __('pages.Change password') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
