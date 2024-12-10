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
                            <li class="breadcrumb-item"><a href="{{ route('app-links.index') }}">Post</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Edit Post</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Post</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">


                        <form class="needs-validation" id="form-post" method="POST"
                            action="{{ route('post.update', $post->id) }}" novalidate="" enctype="multipart/form-data">
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
                                <label for="product-summary">Title</label>
                                <input type="text" class="form-control slug_check" name="title"
                                    value="{{ $post->title }}" placeholder="Please enter Name" id="title">
                            </div>
                            <div class="form-group" id="slug-group">
                                <label for="product-summary">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                    value="{{ $post->slug }}" placeholder="Please enter slug" required
                                    data-parsley-trigger="keyup" data-parsley-required-message="The slug field is required"
                                    data-parsley-class-handler="#slug-group" data-parsley-minlength="2"
                                    data-parsley-minlength-message="slug must contains more than 2 characters"
                                    data-parsley-pattern="^[a-z0-9]+(?:-[a-z0-9]+)*$"
                                    data-parsley-pattern-message="Please enter valid slug">
                                @if ($errors->has('slug'))
                                    <span class="text-danger">
                                        {{ $errors->first('slug') }}
                                    </span>
                                @endif
                                <span class="text-danger" id="slug-error"></span>
                            </div>
                            <div class="form-group">
                                <label for="product-summary">Meta Description</label>
                                <textarea class="form-control" name="meta_description" placeholder="Meta Description">{{ $post->meta_description }}</textarea>
                            </div>
                            <div class="form-group">
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
                                    <button type="submit" id="submit-btn"
                                        class="btn btn-primary waves-effect waves-light submit-btn">Submit</button>
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
            toolbar: [{
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-',
                        'RemoveFormat'
                    ]
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink']
                },
                {
                    name: 'insert',
                    items: ['Image', 'Table', 'HorizontalRule']
                },
                {
                    name: 'styles',
                    items: ['Styles', 'Format', 'Font', 'FontSize']
                }, // Add Font and FontSize
                {
                    name: 'colors',
                    items: ['TextColor', 'BGColor']
                }, // Optionally, you can add color pickers
                {
                    name: 'tools',
                    items: ['Maximize']
                }
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


       

        $('.slug_check').on('keyup', function() {
            $('#slug').val(createSlug($('#title').val()));
            let isSlugValid = false; 
            var slug = $('#slug').val();
            var title = $('#title').val();

            $.ajax({
                url: "{{ route('admin.post.slug.check') }}",
                type: "POST",
                data: {
                    slug: slug,
                    title: title,
                    _token: '{{ csrf_token() }}',
                },
                success: function(data) {
                    console.log(data);

                    if (data.status == true) {
                        $('#slug-error').text('');

                    } else {
                        $('#slug-error').text('Slug already exist');
                    }

                }
            });
        });
    </script>
@endsection
