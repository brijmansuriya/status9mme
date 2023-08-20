@extends('web.layouts.app')


@section('content')
<!-- Main News Slider Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">

            @foreach ($posts as $post)
            <div class="col-md-9 mb-3">
                <a class="h3 m-0" href="{{route('web.popularpost',['slug' => $post->slug])}}">
                <div class="d-flex mb-9">
                    <img src="{{$post->image}}" style="width: 200px;height:200px;object-fit: cover;">
                    <div class="w-100 d-flex flex-column pt-4 bg-light px-3">
                        <div class="mb-1" style="font-size: 13px;">
                            <div>{{$post->category->name ?? ''}}</div>
                            <span>{{$post->created_at}}</span>
                        </div>
                        <div>
                            {{$post->title}}
                        </div>
                        <div class="h6 m-0">{{$post->meta_description}}</div>
                    </div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
        {!! $posts->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>
<!-- Main News Slider End -->

@endsection