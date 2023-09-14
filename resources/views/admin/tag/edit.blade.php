@extends('layouts.master')

@section('css')
<link href="{{ URL::asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css" />
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
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tag.index') }}">Category</a></li>
            <li class="breadcrumb-item active">Edit Category</li>
          </ol>
        </div>
        <h4 class="page-title">Edit Category</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->

  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                {{-- class="needs-validation " --}}
                <form  method="POST" action="{{ route('tag.update',$tag->id) }}" novalidate="" enctype="multipart/form-data" data-parsley-validate="">
                    @csrf

                    <div class="form-group" id="tag-name-group">
                        <label for="product-summary">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $tag->name }}" placeholder="Please enter name" required data-parsley-trigger="keyup" data-parsley-required-message="The name field is required" data-parsley-class-handler="#tag-name-group" data-parsley-minlength="2" data-parsley-minlength-message="Name must contains more than 2 characters" data-parsley-pattern="^[a-zA-Z_ ]*$" data-parsley-pattern-message="Please enter valid name">
                        @if ($errors->has('name'))
                                    <span class="text-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                        @endif
                    </div>

                    <div class="form-group" id="jsCategoryImageStoreSection">


                    
          
                    <div class="form-row">
                        <div class="col-md-6">
                        </div>
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-default waves-effect waves-light" id="jsAddCategoryButton">Submit</button>
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
    $("#js-category-image-input").change(function () {
        $('#jsCategoryImageStoreSection .parsley-mimeType').hide();
        var fileExtension = ['jpeg', 'jpg', 'png'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#jsImageTypeErrorMsg').fadeIn().text("The image must be a file of type: jpg, png, jpeg");
            $('#categoryImgPreview').hide();
            $('#js-category-image-input').val('');
            // $('#js-image-div').hide();
            $('#jsAddCategoryButton').prop('disabled', true);
        } else {
            $('#jsImageTypeErrorMsg').hide();
            $('#jsAddCategoryButton').prop('disabled', false);
            const file = this.files[0];
            if (file){
            let reader = new FileReader();
            reader.onload = function(event){
                $('#js-admin-profile-image').hide();
                // $('#js-image-div').show();
                $('#categoryImgPreview').show();
                $('#categoryImgPreview').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
            }
        }
    });
</script>


@endsection
