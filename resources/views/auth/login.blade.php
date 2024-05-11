<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} </title>

    <link rel="shortcut icon" href="{{ url('assets/images/logo/favicon.ico') }}" size=16*16>
    <link href="{{ URL::asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/website/css/parsley.css') }}">

    <style>
        .card-box {
            margin-bottom: 0; /* Ensure no space between cards */
        }

        /* Adjust the width of the image container */
        .col-md-6 .wrapper-page {
            padding: 20px;
        }

        /* Center the image */
        .col-md-6 .image-container {
            height: 100%; /* Set height to fill parent container */
            overflow: hidden; /* Hide overflowing content */
        }

        .col-md-6 img {
            display: block;
            margin: 0 auto;
            max-width: 100%; /* Make sure the image doesn't exceed its container's width */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>

<body class="authentication-bg authentication-bg-pattern">
    <div class="bg-white row">
        <div class="col-md-6">
            <div class="wrapper-page">
                <div class="card-box">
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $message)
                            <div class="alert alert-danger display-hide" id="errorBlock">
                                <button class="close" data-close="alert"></button>
                                <span>{{ $message }}</span>
                            </div>
                        @endforeach
                    @endif
                    <div class="panel-heading logo text-info">
                        <img src="{{ url('assets/images/logo/logo.png') }}"
                            style="width:100%;height: 150px;object-fit: scale-down;padding: 25px;">
                    </div>
                    <form action="{{ route('login') }}" method="post" data-parsley-validate="">
                        @csrf
                        <input type="hidden" name="" value="">
                        <div class="form-group ">
                            <div class="col-12">
                                <input type="hidden" name="role" value="admin">
                                <label class="form-control-label">Email</label>
                                <input class="form-control" type="email" required="" name="email" id="email"
                                    placeholder="Email" data-parsley-required-message="Please enter an email"
                                    data-parsley-pattern="^[a-z0-9._-]+@[a-z0-9.-]+\.[a-z][a-z]+$"
                                    data-parsley-pattern-message="Please enter a valid email address">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <label class="form-control-label">Password</label>
                                <input class="form-control" type="password" id="password" required=""
                                    name="password" placeholder="Password"
                                    data-parsley-errors-container="#password-error"
                                    data-parsley-validation-threshold="1" data-parsley-trigger="keyup"
                                    data-parsley-required-message="Please enter password.">
                                <!-- <a href="forgot_password" class="text-dark p-t-1"><i class="fa fa-lock m-r-5"></i> Forgot
                your password?</a> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                {{-- <a href="{{ route('allUsers.showResetEmailForm', ['user_type' => 'admins']) }}"
                                    class="text-dark p-t-1">
                                    <i class="fa fa-lock m-r-5"></i>Forgot your password?</a> --}}


                            </div> <!-- end col -->
                        </div>

                        <div class="form-group text-center m-t-40">
                            <div class="col-12">
                                <button class="btn btn-secondary btn-block text-uppercase waves-effect waves-light py-2"
                                    type="submit">Log In
                                </button>
                            </div>
                        </div>
                        <div class="form-group m-t-30 m-b-0">
                            <div class="col-12">

                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 p-0 m-0">
            <div class="image-container">
                <img src="https://source.unsplash.com/random/">
            </div>
        </div>
    </div>


    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
</body>


<script>
    $(document).ready(function() {
        $("#errorBlock").delay(5000).slideUp(300);
    });
</script>

</html>
