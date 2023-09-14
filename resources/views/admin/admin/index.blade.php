@extends('layouts.master')

@section('css')
    <!-- third party css -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Admin List</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Admin List</h4>
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
                                    <a type="button" class="btn btn-sm btn-primary waves-effect waves-light mb-2 mr-2"
                                        href="{{ route('admin.create') }}">Add Admin</a>
                              
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            {{ $dataTable->table() }}

                        </div>
                    </div> <!-- end card-body-->
                </div>
            </div>
        </div>
    </div>

    <!-- container -->
@endsection

@section('script')
    <!-- third party js -->
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/custombox/custombox.min.js') }}"></script>

    <!-- Datatables init -->
    <script src="{{ asset('assets/libs/morris-js/morris-js.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/delete-record.js') }}"></script>
   @push('scripts')
       {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
   @endpush
@endsection