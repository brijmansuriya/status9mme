@extends('layouts.master')

@section('css')
    <!-- third party css -->
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
                            action="{{ route('post.update', $post->id) }}" novalidate=""
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="product-summary">Category</label>
                                <select name="category_id" id="category" class="form-control select2">
                                    @foreach ($categorys as $category)
                                        <option value="{{ $category->id }}" @if($category->id == $post->category_id) selected  @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            @php $post_tags = $post->tags->pluck('tag_id')->toArray(); @endphp

                            <div class="form-group">
                                <label for="product-summary">Tag</label>
                                <select name="tags[]" id="tag" class="form-control tagtest"  multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" 
                                            @if(in_array($tag->id,$post_tags)) selected @endif>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product-summary">title</label>
                                <input type="text" class="form-control" name="title"
                                    value="{{ $post->title }}" placeholder="Please enter Name">
                            </div>
                          
                            <div class="form-group">
                                <label for="product-summary">Meta Description</label>
                                <textarea class="form-control" name="meta_description" placeholder="Meta Description">{{ $post->meta_description }}</textarea>
                            </div>
                            <div class="form-group" id="ckblock">
                                <label for="product-summary">description</label>
                                <textarea class="ckeditor form-control" name="description" placeholder="Content">{{ $post->description }}</textarea>
                            </div>
                            <div class="form-group" id="fileblock">
                                <label for="product-summary">Upload File</label>
                                <input type="file" class="form-control" name="image" id="image-tham">
                            </div>
                            <div class="col-md-12 mt-2" id="jsUserImagePreview">
                                <img id="preview-image-before-upload" height="150" width="160" src="{{$post->image}}">
                            </div>
                            <div class="form-group">
                                <label for="product-summary">Url</label>
                                <input type="text" class="form-control" name="url"
                                    value="{{$post->url}}" placeholder="Please enter Url">
                            </div>
                  

                            <div class="form-row">
                                <div class="col-md-6">
                                </div>
                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-default waves-effect waves-light">Submit</button>
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
    <script>
        var ids = @json($post->tags->pluck('tag_id')->toArray());
        $(document).ready(function() {
            console.log('::::::::::::',ids);
            $('#tag').select2();
            $('.tagtest').val(ids).trigger('change');
        });
    </script>
@endsection
