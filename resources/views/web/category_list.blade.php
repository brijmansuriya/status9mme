@extends('web.layouts.app')


@section('content')
<!-- Main News Slider Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-9 mb-3">
                <div class="row">
                    @foreach ($categorys as $category)
                    <a href="{{route('web.categories',[$category->slug])}}">
                        <div class="col-md-3 mb-3">
                            <div class="d-flex ">
                                <img src="{{$category->category_image}}" style="width: 200px;height:200px;object-fit: cover;">
                            </div>
                            {{$category->name}}
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-3 mb-3">
            </div>


        </div>
    </div>
</div>
<!-- Main News Slider End -->

@endsection