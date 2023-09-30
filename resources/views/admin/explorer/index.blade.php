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
                        <li class="breadcrumb-item"><a href="{{ route('explorer.index') }}">Explorer</a></li>
                        <li class="breadcrumb-item"><a href="#">Add Explorer</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Explorer</h4>
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
                                <a type="button" id="delete_record"
                                    class="btn btn-primary waves-effect waves-light mb-2"
                                    href="javascript:void(0)">Delete All</a>
                                <a type="button" class="btn btn-primary waves-effect waves-light mb-2 mr-2"
                                    href="{{ route('explorer.create') }}">Add Explorer</a>
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
</div> <!-- container -->
@endsection
@section('script')
<!-- third party js -->
<script src="{{ asset('assets/libs/datatables/datatables.min.js')}}"></script>
<!-- Datatables init -->
<script src="{{ asset('assets/js/pages/datatables.init.js')}}"></script>
<script src="{{ asset('assets/js/pages/delete-record.js') }}"></script>
<script src="{{ asset('assets/js/pages/change-record-status.js') }}"></script>
<script>
    // Check all 
   $('#checkall').click(function(){
      if($(this).is(':checked')){
         $('.delete_check').prop('checked', true);
      }else{
         $('.delete_check').prop('checked', false);
      }
   });

   // Delete record
   $('#delete_record').click(function(){

      var deleteids_arr = [];
      // Read all checked checkboxes
      $(".delete_check:checked").each(function () {
         deleteids_arr.push($(this).val());
      });
      console.log('deleteids_arr',deleteids_arr);
      // Check checkbox checked or not
      if(deleteids_arr.length > 0){

         // Confirm alert
         var confirmdelete = confirm("Do you really want to Delete records?");
         if (confirmdelete == true) {
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
               url: '{{ route("explorer.deleteAll") }}',
               type: 'post',
               data: {ids: deleteids_arr},
               success: function(response){
                  var dataTable = $('#explorer-table').DataTable();
                    dataTable.ajax.reload();
               }
            });
         } 
      }
   });

   // Checkbox checked
   function checkcheckbox(){
        // Total checkboxes
        var length = $('.delete_check').length;
        // Total checked checkboxes
        var totalchecked = 0;
        $('.delete_check').each(function(){
            if($(this).is(':checked')){
                totalchecked+=1;
            }
        });
        // Checked unchecked checkbox
        if(totalchecked == length){
            $("#checkall").prop('checked', true);
        }else{
            $('#checkall').prop('checked', false);
        }
    }
</script>
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
@endsection