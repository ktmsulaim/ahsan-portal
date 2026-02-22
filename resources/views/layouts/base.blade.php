@include('components.header', ['body_class' => 'layout-default'])

    <div class="preloader"></div>

    @yield('app_header')
    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->
        @include('components.admin_header')

        <!-- // END Header -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content">

            <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
                <div class="mdk-drawer-layout__content page">
                    <div class="container-fluid page__heading-container">
                        <div class="page__heading d-flex align-items-center flex-wrap">
                            <div class="flex">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i
                                                    class="material-icons icon-20pt">home</i> Home</a></li>
                                        @yield('breadcrumb')
                                    </ol>
                                </nav>
                            </div>
                            @yield('action_button')
                            @auth('admin')
                            <div class="d-flex d-lg-none align-items-center ml-auto page__heading-account">
                                <div class="dropdown">
                                    <a href="#page_account_menu" class="btn btn-account d-flex align-items-center py-2 px-2" data-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('assets/images/user.png') }}" class="rounded-circle flex-shrink-0 mr-1" width="28" height="28" alt="">
                                        <span class="text-dark font-weight-medium">{{ auth('admin')->user()->name }}</span>
                                        <i class="material-icons text-muted ml-1">arrow_drop_down</i>
                                    </a>
                                    @include('components.admin_account_dropdown', ['menuId' => 'page_account_menu', 'menuClass' => 'page__heading-account-menu'])
                                </div>
                            </div>
                            @endauth
                            {{-- <a href=""
                                   class="btn btn-success ml-1">Action</a> --}}
                        </div>
                    </div>

                    <div class="container-fluid page__container">
                        @yield('content')
                    </div>

                </div>
                <!-- // END drawer-layout__content -->

                @include('components.admin_navbar')
            </div>
            <!-- // END drawer-layout -->

        </div>
        <!-- // END header-layout__content -->

    </div>
    <!-- // END header-layout -->

    <!-- App Settings FAB -->
@include('components.footer')