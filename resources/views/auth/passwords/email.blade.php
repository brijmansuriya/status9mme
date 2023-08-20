<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>

    <link rel="shortcut icon" href="{{ url('assets/images/logo/favicon.ico') }}" size=16*16>
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/website/css/parsley.css') }}">
</head>

<body class="authentication-bg authentication-bg-pattern" style=" background-color: #e3e3e3;">
    <div class="bg-white row">
        <div class="col-md-6" style="background-color: #000;">
            <div class="wrapper-page">
                <div class="card-box" style="border:none;">
                    {{-- <div class="panel-heading logo text-info">
                        <img src="{{ url('assets/images/logo/logo.png') }}"
                            style="width:100%;height: 150px;object-fit: scale-down;padding: 25px;">
                    </div> --}}

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @error('email')
                        <div class="mt-4 alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror

                    <form method="POST" action="{{ route('password.email') }}" data-parsley-validate="">
                        @csrf
                        <input type="hidden" class="form-control" name="user_type" value="{{ $user_type }}"
                            required>
                        <div class="form-group ">
                            <div class="col-12">
                                <label class="form-control-label">Email</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus
                                    style="border: 2px solid #E3E3E3;padding: 25px;"  required data-parsley-type="email" data-parsley-trigger="keyup" data-parsley-required-message="The email field is required" data-parsley-class-handler="#admin-email-group">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <p class="text-dark p-t-1">Back to <a href="{{ route('admin.login') }}"
                                        class="text-dark p-t-1"><b>Log in</b></a></p>
                            </div> <!-- end col -->
                        </div>

                        <div class="form-group text-center m-t-10">
                            <div class="col-12">
                                <button class="btn btn-default btn-block text-uppercase waves-effect waves-light"
                                    type="submit"
                                    style="background: #6ca5b3;border: 1px solid #00000000;padding: 14px;">Reset
                                    Password
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
        <div class="col-md-6" style="background-color:#000;text-align: center;">
            {{-- <img src="{{ url('assets/images/logo/favicon.ico') }}"
                style="width: 45%;
        margin-top: 16em;object-fit: scale-down;"> --}}
        </div>
    </div>

    {{-- <script src="http://parsleyjs.org/dist/parsley.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

    <script type="text/javascript" src="{{ URL::asset('assets/website/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.alert-danger').fadeIn().delay(5000).fadeOut();
            $('.alert-success').fadeIn().delay(5000).fadeOut();
        });
    </script>

</body>

</html>

