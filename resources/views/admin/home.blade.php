@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <style>
        @media only screen and (max-width:1024px) and (min-width:768px) {
            /* #morris-donut-example{
                    height: 180px !important;
                } */
        }
    </style>
@endsection

@section('content')
    <!-- Start content -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-3">
                    <div class="page-title-right">


                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <a class="col-md-6 col-xl-3" href="{{ route('admin.index') }}">
                <div>
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                    <i class="ti-user text-info font-22 avatar-title "></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $admin }}</span></h3>
                                    <p class="text-muted mb-1">Admin</p>
                                </div>
                            </div>
                        </div>
                        <!-- end row-->
                    </div>
                    <!-- end widget-rounded-circle-->
                </div>
            </a>
            <a class="col-md-6 col-xl-3" href="{{ route('categorie.index') }}">
                <div>
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                    <i class="ti-layers-alt text-info font-22 avatar-title "></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $categorie }}</span></h3>
                                    <p class="text-muted mb-1">Categories</p>
                                </div>
                            </div>
                        </div>
                        <!-- end row-->
                    </div>
                    <!-- end widget-rounded-circle-->
                </div>
            </a>
        </div>
    </div>
    <input type="hidden" id="customerListUrl" value="{{ json_encode(route('admin.home')) }}">
@endsection

@section('script')
    {{-- <script src="{{ asset('assets/libs/morris-js/morris.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard-4.init.js') }}"></script> --}}

    <!-- Init js -->
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
@endsection
