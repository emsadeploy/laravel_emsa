<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <link href="/css/icons.min.css" rel="stylesheet" type="text/css" />

    <link href="/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <!-- App Css-->
    <link href="/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- App js -->
        

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<!--<body class="sidebar-enable vertical-collpsed" data-bs-theme="dark"> -->
<body class="" data-sidebar="dark" >
    <div id="layout-wrapper">

        @include("partials/topbar")
        @include("partials/sidebar")
        
        <div class="main-content" id="app" >
            <div class="page-content">
                    <div class="container-fluid">
            @yield('content')
                    </div>
            </div>
        </div>

    </div>
</body>
</html>
