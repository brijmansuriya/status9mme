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


        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row mb-2 ">
                        <div class="col-lg-6">
                            <h4 class="header-title mb-3">Sub Category List</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-lg-right">
                                 <a href="{{ route('sub-category.create', $category->id ) }}" class="btn btn-default waves-effect waves-light mb-2 mr-2" >Add Sub Category</a>
                                {{-- <a type="button" target="_blank" href="{{ route('category.export',['type'=>'excel'])}}" class="btn btn-info waves-effect mb-2">XLSX Export</a>
                                <a type="button" target="_blank" href="{{ route('category.export',['type'=>'csv']) }} "
                                    class="btn btn-info waves-effect mb-2">CSV Export</a>
                                <a type="button" target="_blank" href="{{ route('category.export',['type'=>'pdf'])}}"
                                    class="btn btn-info waves-effect mb-2">PDF Export</a> --}}

                            </div>
                        </div><!-- end col-->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered mb-0" id="subcategoryDataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Id</th>
                                    <th>category Image</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>KYC Status</th>
                                    <th>Created on</th>
                                    <th style="width: 125px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div>
        </div>
    </div>

    <input type="hidden" value="{{ json_encode(route('sub-category.dataTable',$category->id )) }}" id="dataTableUrl">

    </div> <!-- container -->
@endsection

@section('script')
    <!-- third party js -->
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/custombox/custombox.min.js') }}"></script>

    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('assets/libs/morris-js/morris-js.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/delete-record.js') }}"></script>
    <script src="{{ asset('assets/js/pages/change-record-status.js') }}"></script>

    <script src="{{ asset('assets/js/pages/sub-category-data-table.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('input[aria-controls=contactUsDataTable]').keyup(function() {
                var searchval = $("input[aria-controls=contactUsDataTable]").val();
                $("#csv").attr("href", "{{ route('contactUs.export', ['type' => 'csv']) }}?search=" + searchval);
                $("#excel").attr("href", "{{ route('contactUs.export', ['type' => 'excel']) }}?search=" +
                searchval);
                $("#pdf").attr("href", "{{ route('contactUs.export', ['type' => 'pdf']) }}?search=" + searchval);
            //    alert(searchval);
            });
        });
    </script>
@endsection
