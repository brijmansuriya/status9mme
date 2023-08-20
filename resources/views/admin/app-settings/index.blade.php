@extends('layouts.master')

@section('css')
    <!-- third party css -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/custombox/custombox.min.css') }}" rel="stylesheet">
    <!-- third party css end -->
    <style>
        /* CSS Switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background: transparent linear-gradient(99deg, #ffffff -50%, #db3128 100%) 0% 0% no-repeat;
            ;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #FA7A7B;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
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
                            <li class="breadcrumb-item"><a href="{{ route('app-settings.index') }}">Setting</a></li>
                            <li class="breadcrumb-item"><a href="#">App Settings</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">App Settings</h4>
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
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table id="appSettingsDataTable" class="table table-centered table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        {{-- <th>App Name</th> --}}
                                        <th>App Label</th>
                                        <th>App Version</th>
                                        <th>App Force Updates</th>
                                        <th>App Maintenance Mode</th>
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
            <form id="updateappSettings" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update App Setting</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-4" class="control-label">App Label</label>
                                    <input disabled type="text" class="form-control" id="updateAppLabel" name="app_label"
                                        placeholder="App Label">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-4" class="control-label">App Version</label>
                                    <input type="text" class="form-control" id="updateAppVersion" name="app_version"
                                        placeholder="App Version">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-4" class="control-label">App Force Updates</label>
                                    {{-- <input type="text" class="form-control" id="updateAppUpdates" name="force_updates"
                                        placeholder="App Force Updates"> --}}
                                    <div class="ml-auto switchery-demo">
                                        <label class="switch">
                                            <input type="checkbox" id="updateAppUpdates" name="force_updates"
                                                data-plugin="switchery" value="1" data-color="#db3128"
                                                data-size="small" /><span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-4" class="control-label">App Maintenance Mode</label>
                                    {{-- <input type="text" class="form-control" id="updateAppMaintenanceMode"
                                        name="maintenance_mode" placeholder="App Maintenance Mode"> --}}
                                    <div class="ml-auto switchery-demo">
                                        <label class="switch">
                                            <input type="checkbox" id="updateAppMaintenanceMode" name="maintenance_mode"
                                                data-plugin="switchery" value="1" data-color="#db3128"
                                                data-size="small" /><span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Update App Settings</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.modal -->
    <input type="hidden" id="dataTableUrl" value="{{ json_encode(route('app-settings.dataTable')) }}">
@endsection

@section('script')
    <!-- third party js -->
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/app-settings-data-table.js') }}"></script>
    <script src="{{ asset('assets/js/pages/edit-app-settings.js') }}"></script>
@endsection
