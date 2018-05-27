<header class="header">
    <nav class="navigation">
        <div class="navigation__container">
            <div class="navigation__left">
                <ul class="menu menu__left">
                    <li class="menu__item">
                        <a href="{{route('static.features')}}" class="menu__link">
                            Features
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="{{route('static.pricing')}}" class="menu__link">
                            Pricing
                        </a>
                    </li>
                </ul>
            </div><!--
        --><div class="navigation__logo">
                <a href="{{route('static.landing')}}">My<span>Track</span>r</a>
            </div><!--
        --><div class="navigation__right">
                <ul class="menu menu__right">
                    @auth
                    <li class="menu__item">
                        <span class="menu__link">
                            {{auth()->user()->name}}
                        </span>
                    </li>
                    <li class="menu__item">
                        <a href="{{route('user.settings.index')}}" class="menu__link">
                            Settings
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="{{ route('logout') }}" class="menu__link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign Out
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    @else
                    <li class="menu__item">
                        <a href="{{route('register')}}" class="menu__link">
                            Sign Up
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="{{route('login')}}" class="menu__link">
                            Sign In
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </nav>
        </div>
</header>
