@extends('layouts.master')

@section('css')
    <!-- third party css -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/custombox/custombox.min.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item"><a href="#">Setting</a></li>
                            <li class="breadcrumb-item">App Variable Settings</li>
                        </ol>
                    </div>
                    <h4 class="page-title">App Variable Settings</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <h4 class="header-title mb-3"></h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-lg-right">
                                    <a href="#app-create-con-close-modal"
                                        class="btn btn-default waves-effect waves-light mb-2 mr-2" data-animation="fadein"
                                        data-toggle="modal" data-overlaycolor="#38414a"> Add App Variable</a>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table id="appVariableDataTable" class="table table-centered table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
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

    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <form id="updateAppVariableSettings" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update App Variables</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-4" class="control-label">Name</label>
                                    <input disabled type="text" class="form-control" id="updateName" name="name"
                                        placeholder="App Label">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-4" class="control-label">Value</label>
                                    <input type="text" class="form-control" id="updateValue" name="value"
                                        placeholder="App Label">
                                </div>
                            </div>

                        </div>
                        {{-- <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="field-4" class="control-label">Key</label>
              <input type="text" class="form-control" id="updateKey" disabled name="key"
                placeholder="App Version">
            </div>
          </div>

        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.modal -->

    <div id="app-create-con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <form id="updateAppVariableSettings" action="{{ route('app-variables.store') }}" method="post"
                data-parsley-validate="">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create App Variables</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" id="name-value-group">
                                    <label for="field-4" class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="App Label"
                                        required data-parsley-trigger="keyup"
                                        data-parsley-required-message="The name field is required"
                                        data-parsley-class-handler="#name-value-group">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" id="value-group">
                                    <label for="field-4" class="control-label">Value</label>
                                    <input type="text" class="form-control" name="value" placeholder="App Label"
                                        required data-parsley-trigger="keyup"
                                        data-parsley-required-message="The value field is required"
                                        data-parsley-class-handler="#value-group" data-parsley-type="number">
                                </div>
                            </div>

                        </div>
                        {{-- <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="field-4" class="control-label">Key</label>
                  <input type="text" class="form-control" id="updateKey" disabled name="key"
                    placeholder="App Version">
                </div>
              </div>

            </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.modal -->

    <input type="hidden" id="dataTableUrl" value="{{ json_encode(route('app-variables.dataTable')) }}">
@endsection

@section('script')
    <!-- third party js -->
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/app-variables-data-table.js') }}"></script>
    <script src="{{ asset('assets/js/pages/edit-app-variables.js') }}"></script>

    <script src="http://parsleyjs.org/dist/parsley.js"></script>
@endsection
