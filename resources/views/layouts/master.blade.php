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

    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    @include('layouts.head')
    @vite('resources/css/app.css')

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
                {{-- @include('layouts.right-sidebar') --}}
            </div> <!-- content -->
            @include('layouts.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
    @include('layouts.footer-script')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('.alert-success').fadeIn().delay(5000).fadeOut();
            $('.alert-danger').delay(5000).fadeOut();
        });

        $('#logout').click(function(e) {
            Swal.fire({
                title: "Are you sure you want to Logout?",
                showCancelButton: true,

                confirmButtonColor: "#28D094",

                confirmButtonText: "Yes",

                cancelButtonText: "No"
            }).then(result => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('admin.logout') }}",
                        type: "POST",
                        success: function(data) {
                            location.reload();
                        },
                        error: function(data) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "", "error");
                }
            });
        });
    </script>
     @stack('scripts')
     @vite('resources/js/app.js')
</body>

</html>
