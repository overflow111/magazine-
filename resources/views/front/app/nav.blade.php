<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top">
    <div class="container-lg">
        <a class="navbar-brand" href="{{ route('index') }}" title="@lang('transFront.app-name')">
            <img src="{{ asset('img/syyahat.svg') }}" alt="@lang('transFront.app-name')" height="50">
        </a>
        <div class="mr-auto">
            @if($slogan[0]->setting)
                <img src="{{ Storage::disk('local')->url($slogan[0]->setting) }}"
                     alt="{{ $slogan[0]->setting }}" title="{{ $slogan[1]->setting }}" height="50">
            @endif
        </div>
        <button class="navbar-toggler border-0" style="outline:none;" type="button" data-toggle="collapse" data-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-grid-fill text-danger h3"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbars">
            <ul class="navbar-nav ml-auto text-center font-weight-bold">
                <li class="nav-item">
                    <a class="nav-link mx-xl-2" href="{{ route('index') }}" title="@lang('transFront.home')">@lang('transFront.home')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-xl-2" href="{{ route('posts') }}" title="@lang('transAdmin.posts')">@lang('transAdmin.posts')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-xl-2" href="{{ route('magazines') }}" title="@lang('transAdmin.magazines')">@lang('transAdmin.magazines')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-xl-2" href="{{ route('search') }}" title="@lang('transAdmin.search')"><i class="bi bi-search"></i> @lang('transAdmin.search')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold mx-xl-2 px-xl-3 btn btn-danger text-white rounded-pill" href="{{ route('sale.create') }}" title="@lang('transFront.subscribe')">@lang('transFront.subscribe')</a>
                </li>
                @auth('customer_web')
                    <li class="nav-item">
                        <a class="nav-link text-secondary mx-xl-2" href="{{ route('sales') }}" title="@lang('transAdmin.plans')">@lang('transAdmin.plans')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary mx-xl-2" href="{{ route('logout') }}" title="@lang('transFront.logout')"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            @lang('transFront.logout')
                        </a>
                        <form action="{{ route('logout') }}" method="post" id="logout-form" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link mx-xl-2 dropdown-toggle" href="#" id="language" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(app()->getLocale() == 'tm')
                            <img src="{{ asset('img/flag/tkm.png') }}" alt="Türkmen" height="18" class="border">
                            <span class="d-inline d-lg-none">Türkmen</span>
                        @elseif(app()->getLocale() == 'ru')
                            <img src="{{ asset('img/flag/rus.png') }}" alt="Русский" height="18" class="border">
                            <span class="d-inline d-lg-none">Русский</span>
                        @elseif(app()->getLocale() == 'en')
                            <img src="{{ asset('img/flag/eng.png') }}" alt="English" height="16" class="border">
                            <span class="d-inline d-lg-none">English</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="language">
                        <a class="dropdown-item text-md {{ app()->getLocale() == 'tm' ? 'text-danger':'' }}" href="{{ route('language', 'tm') }}" title="Türkmen">
                            Türkmen
                            @if(app()->getLocale() == 'tm')
                                <i class="bi bi-check2"></i>
                            @endif
                        </a>
                        <a class="dropdown-item text-md {{ app()->getLocale() == 'ru' ? 'text-danger':'' }}" href="{{ route('language', 'ru') }}" title="Русский">
                            Русский
                            @if(app()->getLocale() == 'ru')
                                <i class="bi bi-check2"></i>
                            @endif
                        </a>
                        <a class="dropdown-item text-md {{ app()->getLocale() == 'en' ? 'text-danger':'' }}" href="{{ route('language', 'en') }}" title="English">
                            English
                            @if(app()->getLocale() == 'en')
                                <i class="bi bi-check2"></i>
                            @endif
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>