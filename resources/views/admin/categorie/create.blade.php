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
                            <li class="breadcrumb-item active">Add New Categorie</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add New Categorie</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{-- class="needs-validation " --}}
                        <form method="POST" action="{{ route('categorie.store') }}" novalidate=""
                            enctype="multipart/form-data" data-parsley-validate="">
                            @csrf

                            {{-- <x-admin-inputs-text name="name" id="name"  error="{{ $errors->has('name') ? $errors->first('name') : '' }}" old="{{ old('name') }}" /> --}}

                            <div class="form-group" id="categorie-name-group">
                                <label for="product-summary">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
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
                                <label for="product-summary">Image</label>
                                <input type="file" class="form-control dropify" name="image" value=""
                                    id="image" accept="image/png, image/jpeg, image/jpg" required data-image-uri=""
                                    data-parsley-mime-type="image/png, image/jpeg, image/jpg"
                                    data-parsley-mime-type-message="The image must be a file of type: jpg, png, jpeg"
                                    data-parsley-max-file-size="5"
                                    data-parsley-required-message="The image field is required">
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
    <script type="text/javascript" src="{{ URL::asset('assets/libs/dropify/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#name').on('keyup', function() {
                $('#slug').val(createSlug($('#name').val()));
            });
        });
        </script>
@endsection
