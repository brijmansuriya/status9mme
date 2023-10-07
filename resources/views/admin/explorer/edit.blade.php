@extends('layouts.master')
@section('css')
<!-- third party css -->
<link href="{{ asset('assets/libs/custombox/custombox.min.css') }}" rel="stylesheet">
<!-- third party css end -->
<link href="{{ URL::asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
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
                        {{-- <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li> --}}
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('app-links.index') }}">App Menu Link Settings</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Edit App Menu Link Setting</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Edit App Menu Link Setting</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation " method="POST" action="{{ route('explorer.update', $explorer->id) }}"
                        novalidate="" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="selectize-tags">Keyword </label>
                            <input type="text" name="keywords" class="form-control" id="selectize-tags"
                                value="@if(old('keyword')){{ old('keyword') }}@else{{ $explorer->keywords }} @endif">
                        </div>
                        <div class="form-group">
                            <label for="product-summary">Title</label>
                            <input type="text" class="form-control" name="title"
                                value="@if(old('title')){{ old('title') }}@else{{ $explorer->title }}@endif"
                                placeholder="Please enter Name">
                        </div>
                        <div class="form-group">
                            <label for="product-summary">Meta Description</label>
                            <textarea class="form-control" name="meta_description"
                                placeholder="Meta Description">@if(old('meta_description')){{ old('meta_description') }}@else{{ $explorer->meta_description }}@endif</textarea>
                        </div>
                        <div class="form-group" id="ckblock">
                            <label for="product-summary">Content</label>
                            <textarea class="ckeditor form-control" name="description" placeholder="Content">
                                    @if(old('description')){{ old('description') }}@else{{ $explorer->description }}@endif</textarea>
                        </div>
                        <div class="form-group" id="fileblock">
                            <label for="product-summary">Upload File</label>
                            <input type="file" class="form-control" name="image" value="{{ $explorer->image }}" id="image-tham">
                        </div>
                        <img src="{{ $explorer->image }}" alt="" width="100" height="100">
                        <div class="form-group">
                            <label for="product-summary">Posts</label>
                            <select name="posts[]" id="posts" class="form-control select2"  multiple="multiple">
                                @foreach ($post as $postData)
                                    <option value="{{ $postData->id }}" {{ in_array($postData->id, $explorer->posts->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $postData->id }} | {{ $postData->title }} | {{ $postData->created_at }}
                                    </option>
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
</script>
@endsection