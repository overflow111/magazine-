<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fas fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mx-1">
            <a class="nav-link h5 mb-0 text-gray-500" href="{{ route('index') }}" target="_blank">
                <i class="fas fa-home fa-fw"></i>
            </a>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link h5 mb-0 text-gray-500" href="{{ route('admin.password.edit') }}">
                <i class="fas fa-key fa-fw"></i>
            </a>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link h5 mb-0 text-gray-500" href="{{ route('admin.logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt fa-fw"></i>
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                  style="display: none;">
                @csrf
            </form>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>
        @if(app()->getLocale() != 'tm')
            <li class="nav-item mx-1">
                <a href="{{ route('language', 'tm') }}" class="nav-link">
                    <img src="{{ asset('img/flag/tkm.png') }}" alt="Türkmen" class="border" height="20">
                </a>
            </li>
        @endif
        @if(app()->getLocale() != 'ru')
            <li class="nav-item mx-1">
                <a href="{{ route('language', 'ru') }}" class="nav-link">
                    <img src="{{ asset('img/flag/rus.png') }}" alt="Русский" class="border" height="20">
                </a>
            </li>
        @endif
        @if(app()->getLocale() != 'en')
            <li class="nav-item mx-1">
                <a href="{{ route('language', 'en') }}" class="nav-link">
                    <img src="{{ asset('img/flag/eng.png') }}" alt="English" class="border" height="20">
                </a>
            </li>
        @endif
    </ul>
</nav>