@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Admin</a></li>
                            <li class="breadcrumb-item active">Edit Admin</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Admin</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <form class="needs-validation " method="POST" action="{{ route('admin.update', $admin->id) }}"
                            novalidate="" enctype="multipart/form-data" data-parsley-validate="">
                            @csrf
                            <div class="form-group">
                                <label for="product-summary">Name</label>
                                <!-- <textarea class="form-control" id="product-summary" rows="1" placeholder="Please enter Name" name="name">{{ $admin->name }}</textarea> -->
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name') ? old('name') : $admin->name }}" placeholder="Name"
                                    required data-parsley-trigger="keyup" data-parsley-minlength="2" maxlength="50"
                                    data-parsley-minlength-message="Name must contain at least 2 characters"
                                    data-parsley-required-message="Please enter name"
                                    data-parsley-class-handler="#user-full-name-group"
                                    data-parsley-pattern-message="Please enter valid name"
                                    data-parsley-pattern="^[a-zA-Z_ ]*$"
                                    data-parsley-pattern-message="Please enter valid name">
                            </div>

                            <div class="form-group">
                                <label for="product-summary">Email</label>
                                <!-- <textarea class="form-control" id="product-summary" rows="1" placeholder="Please enter Email" name="email">{{ $admin->email }}</textarea> -->
                                <input type="email" class="form-control" name="email" value="{{ $admin->email }}"
                                    placeholder="Email" required data-parsley-type="email"
                                    data-parsley-trigger="keyup"
                                    data-parsley-required-message="Please enter email">
                            </div>
                            @if ($admin->id == auth()->user()->id)
                                <div class="form-group">
                                    <label for="product-summary">Current Password</label>
                                    <!-- <textarea class="form-control" id="product-summary" rows="1" placeholder="Please enter password"
                                        name="correct_answer">{{ old('correct_answer') }}</textarea> -->
                                    <input type="password" name="current_password" class="form-control"
                                        placeholder="Current Password" data-parsley-minlength="8"
                                        data-parsley-minlength-message="Minimum 8 characters are required"
                                        data-parsley-pattern='^[^\s]+(\s+[^\s]+)*$' maxlength="15"
                                        data-parsley-pattern-message="Your password can’t start or end with a blank space">
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="product-summary">New Password</label>
                                <!-- <textarea class="form-control" id="product-summary" rows="1" placeholder="Please enter password"
                                    name="correct_answer">{{ old('correct_answer') }}</textarea> -->
                                <input type="password" id="newPassword" name="new_password" class="form-control"
                                    placeholder="New Password" data-parsley-trigger="keyup"
                                    data-parsley-class-handler="#user-password-group" data-parsley-minlength="8"
                                    data-parsley-minlength-message="Minimum 8 characters are required"
                                    data-parsley-pattern='^[^\s]+(\s+[^\s]+)*$' maxlength="15"
                                    data-parsley-pattern-message="Your password can’t start or end with a blank space">
                            </div>
                            <div class="form-group">
                                <label for="product-summary">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control"
                                    placeholder="Confirm Password" data-parsley-trigger="keyup"
                                    data-parsley-class-handler="#user-password-group" data-parsley-minlength="8"
                                    data-parsley-minlength-message="Minimum 8 characters are required" 
                                    data-parsley-equalto="#newPassword" data-parsley-equalto-message="New password and confirm password should be the same."
                                     data-parsley-pattern='^[^\s]+(\s+[^\s]+)*$' maxlength="15"
                                    data-parsley-pattern-message="Your password can’t start or end with a blank space">
                            </div>
                            <div class="form-group">
                                <label for="product-summary">Profile Picture</label>
                                <input type="file" class="form-control" id="jsAdminProfileImage" name="image"
                                    value=" " placeholder="Name"
                                    accept="image/png, image/gif, image/jpeg, image/webp">
                                <span id="jsImageTypeErrorMsg" style="color: #f1556c;"></span>
                            </div>
                            <div>
                                <img src="{{ $admin->profile_picture }}" alt="" height="150" width="160"
                                    id="js-admin-profile-image">
                            </div>
                            <img src="#" alt="" id="imgPreview" height="150" width="160"
                                style="display: none;">

                            <div class="form-row">
                                <div class="col-md-6">
                                </div>
                                <div class="form-group col-md-6">
                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-light">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>




    </div> <!-- container -->
@endsection

@section('script')
    <!-- third party js -->

    <script>
        $(document).ready(() => {
            $('#jsAdminProfileImage').change(function() {
                var fileExtension = ['jpeg', 'jpg', 'png', 'webp'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    $('#jsImageTypeErrorMsg').fadeIn().text(
                        "The profile image must be a file of type: jpg, png, jpeg, webp, etc.");
                    setTimeout(function() {
                        $('#jsImageTypeErrorMsg').text(
                            "The profile image must be a file of type: jpg, png, jpeg, webp, etc."
                        ).fadeOut("slow");
                    }, 5000);
                    $('#imgPreview').hide();
                    $('#jsAdminProfileImage').val('');
                } else {
                    $('#jsImageTypeErrorMsg').hide();
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function(event) {
                            $('#js-admin-profile-image').hide();
                            $('#imgPreview').show();
                            $('#imgPreview').attr('src', event.target.result);
                        }
                        reader.readAsDataURL(file);
                    }
                }
            });
        });
    </script>

    <!-- Init js-->
@endsection
