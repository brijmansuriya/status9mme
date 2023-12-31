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
                        <li class="breadcrumb-item"><a href="{{ route('tag.index') }}">tag</a></li>
                        <li class="breadcrumb-item active">tag List</li>
                    </ol>
                </div>
                <h4 class="page-title">tag List</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    {{-- <div class="row">
    <div class="col-lg-12">
      <div class="card-box" dir="ltr">
        <h4 class="header-title mb-3">Customers Count This Year</h4>
        <div class="text-center">
          <p class="text-muted font-15 font-family-secondary mb-0">
            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-info"></i> Customers</span>
          </p>
        </div>
        <div id="morris-bar-stacked" style="height: 350px;" class="morris-chart"></div>
      </div> <!-- end card-box-->
    </div> <!-- end col-->
  </div> --}}



    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row mb-2 ">
                        <div class="col-lg-6">
                            <h4 class="header-title mb-3"></h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-lg-right">
                                <a type="button" class="btn btn-default waves-effect waves-light mb-2 mr-2" href="{{ route('tag.create') }}">Add tag</a>
                                {{-- <a type="button" target="_blank" href="{{ route('tag.export',['type'=>'excel'])}}" class="btn btn-info waves-effect mb-2">XLSX Export</a>
                                <a type="button" target="_blank" href="{{ route('tag.export',['type'=>'csv']) }} "
                                    class="btn btn-info waves-effect mb-2">CSV Export</a>
                                <a type="button" target="_blank" href="{{ route('tag.export',['type'=>'pdf'])}}"
                                    class="btn btn-info waves-effect mb-2">PDF Export</a> --}}

                            </div>
                        </div><!-- end col-->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered mb-0" id="tagDataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Status</th>
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


    {{-- <input type="hidden" value="{{  json_encode($chartData) }}" id="chartData"> --}}
    <input type="hidden" value="{{ json_encode(route('tag.dataTable')) }}" id="dataTableUrl">

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

    <script src="{{ asset('assets/js/pages/tag-data-table.js') }}"></script>
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
