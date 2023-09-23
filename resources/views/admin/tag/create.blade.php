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
            <li class="breadcrumb-item"><a href="{{ route('tag.index') }}">tag</a></li>
            <li class="breadcrumb-item active">Add New tag</li>
          </ol>
        </div>
        <h4 class="page-title">Add New tag</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->

  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                {{-- class="needs-validation " --}}
                <form  method="POST" action="{{ route('tag.store') }}" novalidate="" enctype="multipart/form-data" data-parsley-validate="">
                    @csrf

                    <div class="form-group" id="tag-name-group">
                        <label for="product-summary">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Please enter name" required data-parsley-trigger="keyup" data-parsley-required-message="The name field is required" data-parsley-class-handler="#tag-name-group" data-parsley-minlength="2" data-parsley-minlength-message="Name must contains more than 2 characters" data-parsley-pattern="^[a-zA-Z_ ]*$" data-parsley-pattern-message="Please enter valid name">
                        @if ($errors->has('name'))
                                    <span class="text-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                        @endif
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                        </div>
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="jsAddtagButton">Submit</button>
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

@endsection
