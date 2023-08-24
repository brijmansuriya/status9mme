@extends('layouts.master')

@section('css')
    <!-- third party css -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
@endsection

@section('content')
    <!-- Start Content-->

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">Category</a></li> --}}
                        <li class="breadcrumb-item active">Category Details</li>
                    </ol>
                </div>
                <h4 class="page-title">Categoy Details</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <!-- project card -->
            <div class="card d-block align-items-start">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-11">
                            <h5 class="card-title font-16 "> Category Details</h5>
                        </div>
                        <div class="col-md-1">
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success mb-2">Edit</a>
                            {{-- <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger mb-2">Delete</a> --}}
                        </div>
                    </div>
                    <div class="clerfix"></div>

                    <div class="clerfix"></div>

                    <div class="row">
                        <div class="col-md-4 text-break">
                            <label class="mt-2 mb-1 text-capitalize">Name :</label>
                            <p class="">
                                {{ $category->name }}
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 text-break">
                            <label class="mt-2 mb-1 text-capitalize">Category Image  :</label>
                            <p class="">
                                <img src="{{ $category->category_image}}" alt="" height="100" width="100"
                                id="js-admin-profile-image">
                            </p>
                        </div>
                    </div>

                </div> <!-- end card-body-->

            </div> <!-- end card-->

        </div> <!-- end col -->


    </div>

  
    </div> <!-- container -->
@endsection
