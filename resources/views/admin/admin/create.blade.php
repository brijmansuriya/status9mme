@extends('layouts.master')

@section('css')
    <link href="{{ URL::asset('assets/libs/multiselect/multiselect.min.css') }}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item active">Add New Admin</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add New Admin</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">


                        <form class="needs-validation " method="POST" action="{{ route('admin.store') }}" novalidate=""
                            enctype="multipart/form-data" data-parsley-validate="">
                            @csrf

                            <div class="form-group">
                                <label for="product-summary">Name</label>
                                <!-- <textarea class="form-control" id="product-summary" rows="1" placeholder="Please enter Name" name="name">{{ old('name') }}</textarea> -->
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    placeholder="Name" required data-parsley-trigger="keyup"
                                    data-parsley-minlength="2"  maxlength="50"
                                    data-parsley-minlength-message="Name must contain at least 2 characters"
                                    data-parsley-required-message="Please enter name"
                                    data-parsley-class-handler="#user-full-name-group"
                                    data-parsley-pattern="^[a-zA-Z_ ]*$"
                                    data-parsley-pattern-message="Please enter valid name">
                            </div>

                            <div class="form-group">
                                <label for="product-summary">Email</label>
                                <!-- <textarea class="form-control" id="product-summary" rows="1" placeholder="Please enter Email" name="email">{{ old('email') }}</textarea> -->
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    placeholder="Email" required data-parsley-type="email"
                                    data-parsley-trigger="keyup"
                                    data-parsley-required-message="Please enter email">
                            </div>

                            <div class="form-group">
                                <label for="product-summary">Password</label>
                                <!-- <textarea class="form-control" id="product-summary" rows="1" placeholder="Please enter password"
                                    name="correct_answer">{{ old('correct_answer') }}</textarea> -->
                                <input type="password" name="password" class="form-control"
                                    placeholder="Password" required data-parsley-trigger="keyup"
                                    data-parsley-required-message="Please enter password"  maxlength="15"
                                    data-parsley-class-handler="#user-password-group" data-parsley-minlength="8"
                                    data-parsley-minlength-message="Minimum 8 characters are required"
                                    data-parsley-pattern='^[^\s]+(\s+[^\s]+)*$'
                                    data-parsley-pattern-message="Your password can’t start or end with a blank space">
                            </div>

                            <div class="form-group">
                                <label for="product-summary">Profile Picture</label>
                                <input type="file" class="form-control" id="jsAdminProfileImage" name="image"
                                    value="" placeholder="Please enter Name" id="banner-fileinput" 
                                    data-parsley-required-message="Please select profile picture" 
                                    accept="image/png, image/gif, image/jpeg, image/webp"
                                    data-parsley-filemaxmegabytes="15882755"
                                    data-parsley-trigger="change"
                                    >
                                <span id="jsImageTypeErrorMsg" style="color: #f1556c;"></span>

                                <div class="col-md-12 mt-2" id="jsUserImagePreview">
                                    <img id="preview-image-before-upload" height="150" width="160"
                                        style="display:none;">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                </div>
                                <div class="form-group col-md-6">
                                    <button type="submit"
                                        class="btn btn-default waves-effect waves-light ">Submit</button>
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


    <!-- Init js-->
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(e) {
            $('#jsAdminProfileImage').change(function() {
                $('#jsUserProfilePicture .parsley-mimeType').hide();
                var fileExtension = ['jpeg', 'jpg', 'png', 'webp'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    $('#jsImageTypeErrorMsg').fadeIn().text(
                        "The profile image must be a file of type: jpg, png, jpeg, webp, etc.");
                    setTimeout(function() {
                        $('#jsImageTypeErrorMsg').text(
                                "The profile image must be a file of type: jpg, png, jpeg, webp, etc."
                            )
                            .fadeOut("slow");
                    }, 5000);
                    $('#jsAdminProfileImage').val('');
                    $('#jsUserImagePreview').hide();
                } else {
                    $('#jsImageTypeErrorMsg').hide();
                    $('#jsUserImagePreview').show();
                    $('#preview-image-before-upload').show();
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#preview-image-before-upload').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            window.Parsley.addValidator('filemaxmegabytes', {
                requirementType: 'string',
                validateString: function(value, requirement, parsleyInstance) {
                    var file = parsleyInstance.$element[0].files;
                    var maxBytes = requirement;
                    if (file.length == 0) {
                        return true;
                    }
                    return file.length === 1 && file[0].size <= maxBytes;
                },
                messages: {
                    en: 'Maximum file size should be 15MB in profile image'
                }
            });
        
        });
    </script>
@endsection
