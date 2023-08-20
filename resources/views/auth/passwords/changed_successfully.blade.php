<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ config('app.name') }} | {{ $content }} </title>
    <link rel="shortcut icon" href="{{ url('assets/images/logo/favicon.ico') }}" size=16*16>
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link href="{{ URL::asset('css/vendors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/app_.min.css') }} " rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/vertical-menu-modern.css') }} " rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/palette-gradient.min.css') }} " rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/login-register.min.css') }} " rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/style.css') }} " rel="stylesheet" type="text/css">
    <style>
        html body.bg-full-screen-image {
            background: #6ca5b3;
            ;
        }
    </style>
</head>

<body class="vertical-layout vertical-menu-modern 1-column  bg-maintenance-image menu-expanded blank-page blank-page"
    data-open="click" data-menu="vertical-menu-modern" data-col="1-column"
    style="background: #6ca5b3;;">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 box-shadow-3 m-0">
                                <div class="card-body">
                                    <span class="card-title text-center">
                                        <img src="{{ url('assets/images/logo/favicon.ico') }}"
                                            class="img-fluid mx-auto d-block" alt="LOGO"
                                            style="width: 100px; height: 100px; object-fit: scale-down;">
                                    </span>
                                </div>
                                <div class="card-body text-center">
                                    <h3>{{ $content }}</h3>
                                </div>
                                <hr>
                                <p class="socialIcon card-text text-center pt-2 pb-2">

                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
