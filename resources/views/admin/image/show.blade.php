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
                        <li class="breadcrumb-item"><a href="{{ route('image.index') }}">image</a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">image</a></li> --}}
                        <li class="breadcrumb-item active">image Details</li>
                    </ol>
                </div>
                <h4 class="page-title">Image Details</h4>
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
                            <h5 class="card-title font-16 "> image Details</h5>
                        </div>
                        <div class="col-md-1">
                            <a href="{{ route('image.edit', $image->id) }}" class="btn btn-success mb-2">Edit</a>
                            {{-- <a href="{{ route('image.delete', $image->id) }}" class="btn btn-danger mb-2">Delete</a> --}}
                        </div>
                    </div>
                    <div class="clerfix"></div>

                   
                    <div class="row">
                        <div class="col-md-4 text-break">
                            <label class="mt-2 mb-1 text-capitalize">Name :</label>
                            <p class="">
                                {{ $image->name }}
                            </p>
                        </div>
                    </div>

                    <img src="{{ $image->image }}" class="img-fluid w-50 h-50 mt-3 mb-3 " alt="">
                    <div class="clerfix"></div>


                </div> <!-- end card-body-->

            </div> <!-- end card-->

        </div> <!-- end col -->


        
    </div>


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

    <script src="{{ asset('assets/js/pages/delete-record.js') }}"></script>
    <script src="{{ asset('assets/js/pages/change-record-status.js') }}"></script>

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
