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
                        <div class="page__heading d-flex align-items-center">
                            <div class="flex">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i
                                                    class="material-icons icon-20pt">home</i> Home</a></li>
                                        @yield('breadcrumb')
                                         {{-- <li class="breadcrumb-item">Blank</li> --}}
                                        {{--    <li class="breadcrumb-item active"
                                                aria-current="page">Page</li> --}}
                                    </ol>
                                </nav>
                            </div>
                    
                            @yield('action_button')
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