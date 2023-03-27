@include('components.header', ['body_class' => 'layout-login', 'title' => $title ?? 'Login'])

<div class="layout-login__overlay"></div>
<div class="layout-login__form bg-white" data-perfect-scrollbar>
    @yield('content')
</div>

@include('components.footer')
