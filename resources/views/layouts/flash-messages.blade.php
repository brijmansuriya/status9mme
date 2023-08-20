@if ($message = Session::get('success'))
<div class="mt-4 alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="mt-4 alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="mt-4 alert alert-warning alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="mt-4 alert alert-info alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
<div class="mt-4 alert alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</div>
@endif