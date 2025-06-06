
    <li class=" @if(Route::current()->getName() == 'web.homepage') active @endif">
        <a href="{{ url('/') }}">{{ __('public-general.nav-home') }}</a>
    </li>
    <li class=" @if(Route::current()->getName() == 'web.carpooling') active @endif">
        <a href="{{ url('/carpool') }}">{{ __('public-general.nav-carpooling') }}</a>
    </li>
    <li class=" @if(Route::current()->getName() == 'web.carpooling') active @endif">
        <a href="{{ url('/en') }}">{{ __('public-general.nav-sharing') }}</a>
    </li>
    <li class=" @if(Route::current()->getName() == 'web.carpooling') active @endif">
        <a href="{{ url('/en') }}">{{ __('public-general.nav-traffic') }}</a>
    </li>

<!-- Authentication Links -->
@guest
    <li class="separator-left">
        @if ( Config::get('app.locale') == '')
            <a class="" href="{{ route('login', 'en') }}">{{ __('public-general.login') }}</a>
        @else
            <a class="" href="{{ route('login', App::getLocale()) }}">{{ __('public-general.login') }}</a>
        @endif
    </li>
    <li class="button-container"  style="padding-left: 10px;">
        @if ( Config::get('app.locale') == '')
            <a class="" href="{{ route('register', 'en') }}">{{ __('public-general.nav-registrer') }}</a>
        @else
            <a class="" href="{{ route('register', App::getLocale()) }}">{{ __('public-general.nav-registrer') }}</a>
        @endif
    </li>

@else

    <li class="button-container hide-on-mobile-only">
        <div class="dropdown web-dropdown-logged-in" style="margin-left: 10px;">
            <button class="button-web-nav-link">{{ Illuminate\Support\Str::limit(Auth::user()->firstname, 15) }}
                @if(Auth::user()->totalUnreadMessages->count() > 0)
                    <span class="label">{{ Auth::user()->totalUnreadMessages->count() }}
                    </span>
                @endif</button>
            <div class="dropdown-content">
                <a href="{{ route('admin.carpoolOverview', []) }}">
                    {{ __('carpool.my-rides') }}
                </a>
                <a href="{{ route('admin.carpoolOverviewAsPassenger', []) }}">
                    {{ __('carpool.my-rides-as-passenger') }}
                </a>
                <a href="{{ route('admin.carpoolGroupsOverview', []) }}">
                    {{ __('carpool.my-groups') }}
                </a>
                <a href="{{ route('admin.carpoolMessagesSender', [
                                'rideId'                => 0,
                                'conversationPartnerId' => 0
                            ]) }}">
                    {{ __('carpool.my-messages') }}
                    @if(Auth::user()->totalUnreadMessages->count() > 0)
                        <span class="label unread-messages-count" style="top: 2px;">{{ Auth::user()->totalUnreadMessages->count() }}</span>
                    @endif
                </a>
                <a href="{{ url('/admin/user/profile/') }}/{{ Auth::user()->id }}/edit">Mon profil</a>
                <a class="" href="{{ route('logout', App::getLocale()) }}"
                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    Logout
                    <form id="logout-form" action="{{ route('logout', App::getLocale()) }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </div>
        </div>
    </li>

    <li class="show-on-mobile-only"><a href="{{ url('/admin') }}">Le tableau de bord</a></li>
    <li class="show-on-mobile-only"><a href="{{ url('/admin/user/profile/') }}/{{ Auth::user()->id }}/edit">Mon profil</a></li>
    <li class="show-on-mobile-only"><a class="" href="{{ route('logout', App::getLocale()) }}"
           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            Logout
            <form id="logout-form" action="{{ route('logout', App::getLocale()) }}" method="POST" style="display: none;">
                @csrf
            </form>
        </a>
    </li>
@endguest
