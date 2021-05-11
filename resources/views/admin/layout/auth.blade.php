@include('components.header', ['body_class' => 'layout-login-centered-boxed', 'title' => 'Login'])

<div class="layout-login-centered-boxed__form card">
    @yield('content')
</div>

@include('components.footer')
