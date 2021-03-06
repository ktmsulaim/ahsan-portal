<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title }} - Ahsan | Darul Hasanath Islamic College</title>

    <!-- Prevent the app from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="{{ asset('assets/vendor/perfect-scrollbar.css') }}" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    

    <!-- Material Design Icons -->
    <link type="text/css" href="{{ asset('assets/css/vendor-material-icons.css') }}" rel="stylesheet">
    

    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="{{ asset('assets/css/vendor-fontawesome-free.css') }}" rel="stylesheet">
    
    <link type="text/css" href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet">
    
    <link type="text/css" href="{{ asset('assets/css/vendor-flatpickr.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/vendor-flatpickr-airbnb.css') }}" rel="stylesheet">
    
    <link type="text/css" href="{{ asset('assets/css/fileinput.min.css') }}" rel="stylesheet">
    
    {{-- <link type="text/css" href="{{ asset('assets/vendor/datatables/jquery.dataTables.min.css') }}" rel="stylesheet"> --}}
    <link type="text/css" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/vendor/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}">
    
    <link rel="shortcut icon" href="{{ asset('img/icon.png') }}" type="image/x-icon">

    @yield('css')

</head>

<body class="layout-fluid layout-sticky-subnav">