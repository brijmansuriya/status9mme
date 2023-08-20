@extends('layouts.master')

@section('css')
<!-- third party css -->
<link href="{{ asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/libs/custombox/custombox.min.css')}}" rel="stylesheet">
<!-- third party css end -->
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
                        <li class="breadcrumb-item"><a href="{{ route('app-links.index') }}">Setting</a></li>
                        <li class="breadcrumb-item"><a href="#">App Menu Link Settings</a></li>
                    </ol>
                </div>
                <h4 class="page-title">App Menu Link Settings</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-8">

                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right">
                                <a type="button" class="btn btn-default waves-effect waves-light mb-2 mr-2" href="{{ route('post.create') }}">Add Post</a>
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table id="postsDataTable" class="table table-centered table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>View Link</th>
                                    <th>Last Modified</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>


                </div> <!-- end card-body-->
            </div>
        </div>
    </div>



</div> <!-- container -->

<input type="hidden" id="dataTableUrl" value="{{ json_encode(route('post.dataTables')) }}">
@endsection

@section('script')

<!-- third party js -->
<script src="{{ asset('assets/libs/datatables/datatables.min.js')}}"></script>
<!-- third party js ends -->

<!-- Datatables init -->
<script src="{{ asset('assets/js/pages/datatables.init.js')}}"></script>
{{-- <script src="{{ asset('assets/js/pages/app-link-settings-data-table.js')}}"></script> --}}
<script src="{{ asset('assets/js/pages/post-data-table.js')}}"></script>
<script src="{{ asset('assets/js/pages/delete-record.js') }}"></script>
<script src="{{ asset('assets/js/pages/change-record-status.js') }}"></script>
@endsection
