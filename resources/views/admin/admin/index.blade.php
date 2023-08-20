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
                            <!-- <li class="breadcrumb-item"><a href="">FAQs</a></li> -->
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
                                    <a type="button" class="btn btn-default waves-effect waves-light mb-2 mr-2"
                                        href="{{ route('admin.create') }}">Add Admin</a>
                                    {{-- <a type="button" target="_blank" id="excel" href="{{ route('admins.export', ['type' => 'excel']) }} "
                                        class="btn btn-info waves-effect mb-2">XLSX Export</a>
                                    <a type="button" target="_blank" id="csv"  href="{{ route('admins.export', ['type' => 'csv']) }} "
                                        class="btn btn-info waves-effect mb-2">CSV Export</a>
                                    <a type="button" target="_blank" id="pdf" href="{{ route('admins.export', ['type' => 'pdf']) }}"
                                        class="btn btn-info waves-effect mb-2">PDF Export</a> --}}
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            {{-- <table id="adminDataTable" class="table table-centered table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Profile Picture</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table> --}}

                            {{ $dataTable->table() }}

                        </div>
                    </div> <!-- end card-body-->
                </div>
            </div>
        </div>
    </div>

    <!-- container -->
    {{-- <input type="hidden" id="dataTableUrl" value="{{ json_encode(route('admin.dataTable')) }}"> --}}
@endsection

@section('script')
    <!-- third party js -->
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/custombox/custombox.min.js') }}"></script>
    <!-- third party js ends -->

    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('assets/libs/morris-js/morris-js.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/delete-record.js') }}"></script>

    <!-- Datatables init -->
    {{-- <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/pages/admin-data-tables.js') }}"></script> --}}

    <script>
        $(document).ready(function() {
            $('.alert-success').fadeIn().delay(5000).fadeOut();
        });
    </script>
   
   @push('scripts')
       {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
   @endpush
@endsection