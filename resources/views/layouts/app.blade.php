@include('components.user.header')

<div class="preloader"></div>

<!-- Header Layout -->
<div class="mdk-header-layout js-mdk-header-layout">

    <!-- Header -->
    <div id="header" class="mdk-header bg-dark js-mdk-header m-0" data-fixed>
        <div class="mdk-header__content">

            <div class="navbar navbar-expand-sm navbar-main navbar-dark bg-dark pr-0 pr-0" id="navbar" data-primary>
                <div class="container-fluid p-0">

                    <!-- Navbar toggler -->

                     <!-- Navbar Brand -->
                    <a href="{{ route('home') }}" class="navbar-brand ">

                     <img src="{{ asset('img/icon.png') }}" alt="Ahsan logo" width="35">

                        <span>Ahsan</span>
                    </a>

                    <ul class="nav navbar-nav d-none d-sm-flex border-left navbar-height align-items-center">
                        <li class="nav-item dropdown">
                            <a href="#account_menu" class="nav-link dropdown-toggle" data-toggle="dropdown"
                                data-caret="false">
                                <span class="mr-1 d-flex-inline">
                                    <span class="text-light">{{ auth()->user()->name }}</span>
                                </span>
                                <img src="{{ auth()->user()->photo() }}" class="rounded-circle" width="32"
                                    alt="User photo">
                            </a>
                            <div id="account_menu" class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-item-text dropdown-item-text--lh">
                                    <div><strong>{{ auth()->user()->name }}</strong></div>
                                    <div class="text-muted">{{ auth()->user()->email }}</div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('home') }}"><i class="material-icons">dvr</i>
                                    Dashboard</a>
                                <a class="dropdown-item" href="{{ route('profile') }}"><i
                                        class="material-icons">edit</i> Edit account</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('user.logout') }}"><i
                                        class="material-icons">exit_to_app</i> Logout</a>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </div>

    <!-- // END Header -->

    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page">

        <div class="page__header">
            <div class="container-fluid page__heading-container">
                <div class="page__heading d-flex align-items-center">
                    <div class="flex">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="material-icons icon-20pt">home</i> <span class="ml-2">Home</span></a></li>

                                @yield('breadcrumb')
                                {{-- <li class="breadcrumb-item">Blank</li>
                                <li class="breadcrumb-item active" aria-current="page">Page</li> --}}
                            </ol>
                        </nav>
                        {{-- <h1 class="m-0">{{ $title }}</h1> --}}
                    </div>
                </div>
            </div>
        </div> <!-- // END page__header -->

        <div class="page__header page__header-nav">
            <div class="container-fluid page__container">
                <div class="navbar navbar-secondary navbar-light navbar-expand-sm p-0">
                    <button class="navbar-toggler navbar-toggler-right" data-toggle="collapse"
                        data-target="#navbarsExample03" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="navbar-collapse collapse" id="navbarsExample03">
                        <ul class="nav navbar-nav">
                            <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                                <a href="{{ route('home') }}" class="nav-link">Dashboard</a>
                            </li>

                            <li class="nav-item {{ Request::is('profile') ? 'active' : '' }}">
                                <a href="{{ route('profile') }}" class="nav-link">Profile</a>
                            </li>
                            
                            <li class="nav-item {{ Request::is('campaigns*') ? 'active' : '' }}">
                                <a href="{{ route('user.campaigns.index') }}" class="nav-link">Campaigns</a>
                            </li>
                            
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Account</a>
                                <div class="dropdown-menu" style="display: none;">
                                    <a class="dropdown-item" href="{{ route('user.changePassword') }}">Change password</a>
                                    <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid page__container">
            @yield('content')
        </div>

    </div>
    <!-- // END header-layout__content -->

</div>
<!-- // END header-layout -->




@include('components.footer')
