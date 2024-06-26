@extends('web.layouts.app')
@section('css')
    {!! seo()->for($posts) !!}
@endsection
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="container">
            <nav class="breadcrumb bg-transparent m-0 p-0">
                <a class="breadcrumb-item" href="#">Home</a>
                <a class="breadcrumb-item" href="#">Categorie</a>
                <a class="breadcrumb-item" href="#">Technology</a>
                <span class="breadcrumb-item active">News Title</span>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- News With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100 h-50" src="{{ $post->image ?? '' }}"
                            style="object-fit: cover;height: 350px;">
                        <div class="overlay position-relative bg-light">
                            <h2>{{ $post->title }}</h2>
                            <div>{{ $post->categorie->name ?? '' }}</div>
                            <hr>
                            <div>
                                {!! $post->description ?? '' !!}
                            </div>

                            <div class="mb-3">
                                <span>{{ $post->created_at ?? '' }}</span>
                            </div>

                            <a href="{{ $post->url }}?view_as=subscriber" class="my-3 text-center">
                                <<< GO TO YOUTUBE>>>
                            </a>
                            <div class="embed-responsive embed-responsive-16by9">
                                @youtube($post->url)
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 pt-3 pt-lg-0">
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Tranding</h3>
                        </div>

                        @foreach ($trandings as $tranding)
                            <a href="{{ route('web.popularpost', ['slug' => $tranding->slug]) }}">
                                <div class="d-flex mb-3">
                                    <img src="{{ $tranding->image }}"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                    <div class="w-100 d-flex flex-column justify-content-center bg-light px-3"
                                        style="height: 100px;">
                                        <div class="mb-1" style="font-size: 13px;">
                                            <div>{{ $tranding->categorie->name ?? '' }}</div>
                                            <div class="h6 m-0">{{ $tranding->title }}</div>
                                        </div>
                                        <span>{{ $tranding->created_at }}</span>


                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- News With Sidebar End -->
@endsection
