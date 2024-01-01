<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="EWW" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('assets/images/logo/favicon.ico') }}" size=16*16>
    @include('layouts.head')
    @vite(['resources/js/app.js','resources/css/app.css'])

</head>
<body>
    <!-- Begin page -->
    <div id="wrapper">
        <input type="hidden" id="base_url" value="{{ config('app.url') }}">
        @include('layouts.topbar')
        @include('layouts.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                @include('layouts.flash-messages')
                @yield('content')
            </div> <!-- content -->
            @include('layouts.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
    @include('layouts.footer-script')
    @stack('scripts')
</body>
</html>
