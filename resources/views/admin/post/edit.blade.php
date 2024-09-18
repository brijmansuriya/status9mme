@extends('layouts.master')

@section('css')
    <!-- third party css -->
    <link href="{{ asset('assets/libs/custombox/custombox.min.css') }}" rel="stylesheet">
    <!-- third party css end -->
    <link href="{{ URL::asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="{{ route('app-links.index') }}">App Menu Link Settings</a>
                            </li>
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


                        <form class="needs-validation " method="POST" action="{{ route('post.update', $post->id) }}"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="product-summary">Categorie</label>
                                <select name="categorie_id" id="categorie" class="form-control select2">
                                    @foreach ($categorys as $categorie)
                                        <option value="{{ $categorie->id }}"
                                            @if ($categorie->id == $post->category_id) selected @endif>{{ $categorie->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="selectize-tags">Keyword</label>
                                <input type="text" name="keyword" class="form-control" id="selectize-tags"
                                    value="{{ $post->keyword }}">
                            </div>
                            @php $post_tags = $post->tags->pluck('id')->toArray();  @endphp

                            <div class="form-group">
                                <label for="product-summary">Tag</label>
                                <select name="tags[]" id="tag" class="form-control tagtest" multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            @if (in_array($tag->id, $post_tags)) selected @endif>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product-summary">title</label>
                                <input type="text" class="form-control" name="title" value="{{ $post->title }}"
                                    placeholder="Please enter Name">
                            </div>

                            <div class="form-group">
                                <label for="product-summary">Meta Description</label>
                                <textarea class="form-control" name="meta_description" placeholder="Meta Description">{{ $post->meta_description }}</textarea>
                            </div>
                            <div class="form-group" >
                                <label for="product-summary">description</label>
                                <textarea class="ckeditor form-control" name="description" placeholder="Content">{{ $post->description }}</textarea>
                            </div>
                            <div class="form-group" id="fileblock">
                                <label for="product-summary">Upload File</label>
                                <input type="file" class="form-control" name="image" id="image-tham">
                            </div>
                            <div class="col-md-12 mt-2" id="jsUserImagePreview">
                                <img id="preview-image-before-upload" height="150" width="160"
                                    src="{{ $post->image }}">
                            </div>
                            <div class="form-group">
                                <label for="product-summary">Url</label>
                                <input type="text" class="form-control" name="url" value="{{ $post->url }}"
                                    placeholder="Please enter Url" required>
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
    <script src="{{ URL::asset('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script>
        CKEDITOR.replace('editor1', {
        extraPlugins: 'font', // Enable the font plugin
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule'] },
            { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] }, // Add Font and FontSize
            { name: 'colors', items: ['TextColor', 'BGColor'] }, // Optionally, you can add color pickers
            { name: 'tools', items: ['Maximize'] }
        ],
        fontSize_sizes: '8/8px;9/9px;10/10px;12/12px;14/14px;16/16px;18/18px;24/24px;36/36px;48/48px;', // Define available font sizes
        font_names: 'Arial/Arial, Helvetica, sans-serif;' + 
                    'Comic Sans MS/Comic Sans MS, cursive;' + 
                    'Courier New/Courier New, Courier, monospace;' + 
                    'Georgia/Georgia, serif;' + 
                    'Tahoma/Tahoma, Geneva, sans-serif;' + 
                    'Times New Roman/Times New Roman, Times, serif;' + 
                    'Verdana/Verdana, Geneva, sans-serif;', // Define available font styles
    });

        var ids = @json($post->tags->pluck('id')->toArray());
        $(document).ready(function() {
            console.log('::::::::::::', ids);
            $('#tag').select2();
            $('.tagtest').val(ids).trigger('change');
        });

        $("#selectize-tags").selectize({
            delimiter: ",",
            persist: false,
            maxItems: null,
            create: function(input) {
                return {
                    value: input,
                    text: input,
                };
            }
        });
    </script>
@endsection
