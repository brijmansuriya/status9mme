@extends('layouts.master')
@section('css')
    <!-- third party css -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/custombox/custombox.min.css') }}" rel="stylesheet">
    <!-- third party css end -->
    <link href="{{ URL::asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title categorys-->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('app-links.index') }}">Explorer</a></li>
                            <li class="breadcrumb-item"><a href="#">Edit Explorer</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Explorer</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation " method="POST"
                            action="{{ route('explorer.store') }}" novalidate=""
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="selectize-tags">Keyword</label>
                                <input type="text" name="keywords" class="form-control" id="selectize-tags" value="{{ old('keyword') }}">
                            </div>
                            <div class="form-group">
                                <label for="product-summary">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title') }}" placeholder="Please enter Name">
                            </div>
                            <div class="form-group" id="slug-group">
                                <label for="product-summary">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}"
                                    placeholder="Please enter slug" required data-parsley-trigger="keyup"
                                    data-parsley-required-message="The slug field is required"
                                    data-parsley-class-handler="#slug-group" data-parsley-minlength="2"
                                    data-parsley-minlength-message="slug must contains more than 2 characters"
                                    data-parsley-pattern="^[a-z0-9]+(?:-[a-z0-9]+)*$"
                                    data-parsley-pattern-message="Please enter valid slug">
                                @if ($errors->has('slug'))
                                    <span class="text-danger">
                                        {{ $errors->first('slug') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="product-summary">Meta Description</label>
                                <textarea class="form-control" name="meta_description" placeholder="Meta Description">{{ old('meta_description') }}</textarea>
                            </div>
                            <div class="form-group" id="ckblock">
                                <label for="product-summary">Content</label>
                                <textarea class="ckeditor form-control" name="description" placeholder="Content">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group" id="fileblock">
                                <label for="product-summary">Upload File</label>
                                <input type="file" class="form-control" name="image" id="image-tham">
                            </div>
                            <div class="form-group">
                                <label for="product-summary">Posts</label>
                                <select name="posts[]" id="posts" class="form-control select2"  multiple="multiple">
                                    @foreach ($post as $postData)
                                        <option value="{{ $postData->id }}">{{ $postData->id }} | {{ $postData->title }} | {{ $postData->created_at }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                </div>
                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
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
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="{{ URL::asset('assets/libs/selectize/js/standalone/selectize.min.js')}}"></script>
    <script>
        $( document ).ready(function() {
            $('#image-tham').change(function() {
                $('#jsUserProfilePicture').hide();
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
            $('.select2').select2();
        });
        $("#selectize-tags").selectize({
            delimiter: ",",
            persist: false,
            maxItems: null,
            create: function (input) {
                return {
                    value: input,
                    text: input,
                };
            }
        });

        $(document).ready(function () {
            $('#title').on('keyup', function() {
                $('#slug').val(createSlug($('#title').val()));
            });
        });
        </script>
@endsection
