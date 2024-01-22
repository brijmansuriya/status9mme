@extends('web.layouts.app')


@section('content')
    <!-- Main News Slider Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">

                @foreach ($posts as $post)
                    <div class="col-md-9 mb-3">
                        <div class="d-flex mb-9">
                            <img src="{{ $post->image }}" style="width: 200px;height:200px;object-fit: cover;">
                            <div class="w-100 d-flex flex-column pt-4 bg-light px-3">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="">{{ $post->categorie->name ?? '' }}</a>
                                    <span class="px-1">/</span>
                                    <span>{{ $post->created_at }}</span>
                                </div>
                                <a class="h3 m-0"
                                    href="{{ route('web.popularpost', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                <a class="h6 m-0" href="">{{ $post->meta_description }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {!! $posts->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
    <!-- Main News Slider End -->
@endsection
