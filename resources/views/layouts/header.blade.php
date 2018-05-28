<header class="header">
    <nav class="navigation">
        <div class="navigation__container">
            <div class="navigation__left">
                <ul class="menu menu__left">
                    @auth
                    <li class="menu__item">
                        <a href="{{route('projects.index')}}" class="menu__link">
                            My Projects
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="{{route('projects.create')}}" class="menu__link">
                            Create Project
                        </a>
                    </li>
                    @else
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
                    @endauth
                </ul>
            </div><!--
        --><div class="navigation__logo">
                <a href="{{route('static.landing')}}">My<span>Track</span>r</a>
            </div><!--
        --><div class="navigation__right">
                <ul class="menu menu__right">
                    @auth
                    <li class="menu__item">
                        <a href="{{route('home')}}" class="menu__link">
                            {{auth()->user()->name}}
                        </a>
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
        </div>
    </nav>

    <div class="menu__hamburger">
        <i class="fas fa-bars"></i>
        <i class="fas fa-times"></i>
    </div>

    <nav class="mobile-nav">
        <ul class="mobile-menu">
            <li class="mobile-menu__item">
                <a href="{{route('static.landing')}}" class="mobile-menu__link">
                    Home
                </a>
            </li>
            @auth
            <li class="mobile-menu__item">
                <a href="{{route('projects.index')}}" class="mobile-menu__link">
                    My Projects
                </a>
            </li>
            <li class="mobile-menu__item">
                <a href="{{route('projects.create')}}" class="mobile-menu__link">
                    Create Project
                </a>
            </li>
            @else
            <li class="mobile-menu__item">
                <a href="{{route('static.features')}}" class="mobile-menu__link">
                    Features
                </a>
            </li>
            <li class="mobile-menu__item">
                <a href="{{route('static.pricing')}}" class="mobile-menu__link">
                    Pricing
                </a>
            </li>
            @endauth
            @auth
            <li class="mobile-menu__item">
                <a href="{{route('home')}}" class="mobile-menu__link">
                    {{auth()->user()->name}}
                </a>
            </li>
            <li class="mobile-menu__item">
                <a href="{{route('user.settings.index')}}" class="mobile-menu__link">
                    Settings
                </a>
            </li>
            <li class="mobile-menu__item">
                <a href="{{ route('logout') }}" class="mobile-menu__link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sign Out
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            @else
            <li class="mobile-menu__item">
                <a href="{{route('register')}}" class="mobile-menu__link">
                    Sign Up
                </a>
            </li>
            <li class="mobile-menu__item">
                <a href="{{route('login')}}" class="mobile-menu__link">
                    Sign In
                </a>
            </li>
            @endauth
        </ul>
    </nav>
</header>
