<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} </title>
    <link rel="shortcut icon" href="{{ url('assets/images/logo/favicon.ico') }}" size=16*16>

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">

    <link href="{{ URL::asset('web/css/vendors.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('web/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('web/css/vertical-menu-modern.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('web/css/palette-gradient.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('web/css/pages/login-register.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('web/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('web/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('web/css/style.css') }}" rel="stylesheet" type="text/css" />

    {{-- <script href="{{ URL::asset('js/jquery.min.js') }}" rel="stylesheet" type="text/css"></script> --}}
    <style>
        .form-control:focus {
            color: #4E5154;
            background-color: #FFF;
            border-color: #376c7a !important;
            outline: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        html body.bg-full-screen-image {
            background-color: #376c7a;
        }

        .btn-outline-info {
            border-color: #376c7a !important;
            background-color: transparent !important;
            color: #376c7a !important;
        }

        .parsley-errors-list {
            padding-left: 0;
        }

        .parsley-errors-list li {
            list-style-type: none;
            color: red;
        }
    </style>
</head>

<body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image menu-expanded blank-page blank-page"
    data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="mt-4 alert alert-danger alert-block" id="errorMessage"
                                    style="display: none">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong></strong>
                                </div>
                                @include('layouts.flash-messages')
                                <div class="card-header border-0 pb-0">
                                    <div class="card-title text-center">
                                        <img src="{{ url('assets/images/logo/logo.png') }}" style="width:100%;height: 150px;object-fit: scale-down;padding: 25px;">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span>Change Password</span>
                                    </h6>
                                </div>

                                <div class="card-content">
                                    <div class="card-body">
                                         <form method="POST" action="{{ route('password.update') }}" data-parsley-validate="">
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input name='password' id='new' type='password' class='form-control'
                                                    required=true data-parsley-minlength='8'
                                                    data-parsley-minlength-message='This value must be at least 8 characters'
                                                    data-parsley-pattern='^[^\s]+(\s+[^\s]+)*$'
                                                    data-parsley-pattern-message="Your password can’t start or end with a blank space">
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input name='password_confirmation' id='new_confirm' type='password'
                                                    pattern='^.{8}.*$' class='form-control' required=true
                                                    data-parsley-equalto='#new'
                                                    data-parsley-equalto-message='New password does not match with confirm password'>
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                            </fieldset>
                                            <input type="hidden" name="user_id" id="user_id" value="">
                                            <input type="hidden" name="email" id="email" value="{{ $email }}">
                                            <input type="hidden" name="token" id="token" value="{{ $token }}">
                                            <button type="submit" class="btn btn-outline-info btn-block"><i
                                                    class="ft-unlock"></i> Change</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

</html>
<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>
