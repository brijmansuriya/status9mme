
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
        background: var(--default) 
        !important;
    }
</style>
@yield('css')