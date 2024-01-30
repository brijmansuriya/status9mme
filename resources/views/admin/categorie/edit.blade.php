@extends('layouts.master')

@section('css')
    <link href="{{ URL::asset('assets/libs/multiselect/multiselect.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="{{ route('categorie.index') }}">Categorie</a></li>
                            <li class="breadcrumb-item active">Edit Categorie</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Categorie</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{-- class="needs-validation " --}}
                        <form method="POST" action="{{ route('categorie.update', $categorie->id) }}" novalidate=""
                            enctype="multipart/form-data" data-parsley-validate="">
                            @csrf

                            <div class="form-group" id="categorie-name-group">
                                <label for="product-summary">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $categorie->name }}"
                                    placeholder="Please enter name" required data-parsley-trigger="keyup"
                                    data-parsley-required-message="The name field is required"
                                    data-parsley-class-handler="#categorie-name-group" data-parsley-minlength="2"
                                    data-parsley-minlength-message="Name must contains more than 2 characters"
                                    data-parsley-pattern="^[a-zA-Z_ ]*$"
                                    data-parsley-pattern-message="Please enter valid name">
                                @if ($errors->has('name'))
                                    <span class="text-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </div>

                            <div class="form-group" id="jsCategoryImageStoreSection">

                                <label for="product-summary">Image </label>
                                <input type="file" class="form-control dropify" name="image"
                                    value="{{ $categorie->image }}" id="js-categorie-image-input"
                                    accept="image/png, image/jpeg, image/jpg" data-image-uri=""
                                    data-parsley-mime-type="image/png, image/jpeg, image/jpg"
                                    data-parsley-mime-type-message="The image must be a file of type: jpg, png, jpeg"
                                    data-parsley-max-file-size="5"
                                    data-parsley-required-message="The image field is required">
                                <span id="jsImageTypeErrorMsg" style="color: #f1556c;"></span>
                            </div>

                            <a href="{{ $categorie->image }}" target="_blank">
                                <img src="{{ $categorie->image }}" width="100" height="100" alt="">
                            </a>

                            <div class="form-row">
                                <div class="col-md-6">
                                </div>
                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"
                                        id="jsAddCategoryButton">Submit</button>
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

    <script type="text/javascript" src="{{ URL::asset('assets/libs/dropify/dropify.min.js') }}"></script>
    @include('includes.inpagejs')
@endsection
