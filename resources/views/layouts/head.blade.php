
<!-- App css -->
<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
{{-- <link href="{{ URL::asset('assets/v3/css/style.css') }}" rel="stylesheet" type="text/css" /> --}}
<link href="{{ URL::asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    label{
        text-transform: capitalize;
    }
    
    .select2-selection__choice{
        background: #38414a !important;
    }

    .active{
        color:  #6658dd !important; 
    }

    #sidebar-menu>ul>li>a:active, #sidebar-menu>ul>li>a:focus, #sidebar-menu>ul>li>a:hover {
        color: #6658dd;
        text-decoration: none;
    }


    /* //admin top heder logo and logout section */

    .navbar-custom {
        background: linear-gradient(90deg, #FDBB2D 0%, #3A1C71 100%);
}
</style>
@yield('css')