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
                            {{-- <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li> --}}
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('app-links.index') }}">App Menu Link Settings</a></li>
                            <li class="breadcrumb-item"><a href="#">Edit App Menu Link Setting</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit App Menu Link Setting</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">


                        <form class="needs-validation " method="POST"
                            action="{{ route('app-links.update', $appLinks->id) }}" novalidate=""
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="product-summary">Show Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $appLinks->show_name }}" placeholder="Please enter Name">
                            </div>
                            <div class="form-group">
                                <label for="product-summary">Select Type</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="ckeditor" {{ $appLinks->type == 'ckeditor' ? 'selected' : '' }}>Editor
                                    </option>
                                    <option value="normal" {{ $appLinks->type == 'normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="file" {{ $appLinks->type == 'file' ? 'selected' : '' }}>File</option>
                                </select>
                            </div>

                            <div class="form-group" id="ckblock"
                                style="display:{{ $appLinks->type == 'ckeditor' ? 'block' : 'none' }} ">
                                <label for="product-summary">Content</label>
                                <textarea class="ckeditor form-control" name="ck_editor_value" placeholder="Content">{{ $appLinks->value }}</textarea>
                            </div>
                            <div class="form-group" id="normalblock"
                                style="display:{{ $appLinks->type == 'normal' ? 'block' : 'none' }} ">
                                <label for="product-summary">Content</label>
                                <input type="text" name="normal_value" class="form-control"
                                    value="{{ $appLinks->value }}">
                            </div>
                            <div class="form-group" id="fileblock"
                                style="display:{{ $appLinks->type == 'file' ? 'block' : 'none' }} ">
                                <label for="product-summary">Upload File:</label>
                                <input type="file" name="file_value">
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                </div>
                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>




    </div> <!-- container -->
@endsection

@section('script')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
        document.getElementById('type').addEventListener('change', function() {
            let value = document.getElementById('type').value;
            if (value == 'ckeditor') {
                document.getElementById('fileblock').style.display = 'none';
                document.getElementById('normalblock').style.display = 'none';
                document.getElementById('ckblock').style.display = 'block';
            }

            if (value == 'normal') {
                document.getElementById('ckblock').style.display = 'none';
                document.getElementById('fileblock').style.display = 'none';
                document.getElementById('normalblock').style.display = 'block';
            }

            if (value == 'file') {
                document.getElementById('ckblock').style.display = 'none';
                document.getElementById('normalblock').style.display = 'none';
                document.getElementById('fileblock').style.display = 'block';
            }
        })
    </script>
@endsection
