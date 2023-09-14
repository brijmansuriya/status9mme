@extends('layouts.master')

@section('css')
<link href="{{ URL::asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
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
            <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
            <li class="breadcrumb-item active">Add New Category</li>
          </ol>
        </div>
        <h4 class="page-title">Add New Category</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->

  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                {{-- class="needs-validation " --}}
                <form  method="POST" action="{{ route('category.store') }}" novalidate="" enctype="multipart/form-data" data-parsley-validate="">
                    @csrf

                    <div class="form-group" id="category-name-group">
                        <label for="product-summary">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Please enter name" required data-parsley-trigger="keyup" data-parsley-required-message="The name field is required" data-parsley-class-handler="#category-name-group" data-parsley-minlength="2" data-parsley-minlength-message="Name must contains more than 2 characters" data-parsley-pattern="^[a-zA-Z_ ]*$" data-parsley-pattern-message="Please enter valid name">
                        @if ($errors->has('name'))
                                    <span class="text-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                        @endif
                    </div>

                    <div class="form-group" >
                        <label for="product-summary">Image</label>
                        <input type="file" class="form-control dropify" name="image" value="" id="image" accept="image/png, image/jpeg, image/jpg" required data-image-uri="" data-parsley-mime-type="image/png, image/jpeg, image/jpg" data-parsley-mime-type-message="The image must be a file of type: jpg, png, jpeg" data-parsley-max-file-size="5" data-parsley-required-message="The image field is required">
                        @if ($errors->has('image'))
                            <span class="text-danger">
                                {{ $errors->first('image') }}
                            </span>
                        @endif
                        
                        <span id="jsImageTypeErrorMsg"></span>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                        </div>
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="jsAddCategoryButton">Submit</button>
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
<script type="text/javascript" src="{{ URL::asset('assets/libs/dropify/dropify.min.js') }}"></script>
@endsection
