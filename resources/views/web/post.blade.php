@extends('web.layouts.app')
@section('css')
    {!! seo()->for($posts) !!}
@endsection
@section('content')
    <!-- Breadcrumb Start -->
    {{-- <div class="container-fluid">
        <div class="container">
            <nav class="breadcrumb bg-transparent m-0 p-0">
                <a class="breadcrumb-item" href="#">Home</a>
                <a class="breadcrumb-item" href="#">Categorie</a>
                <a class="breadcrumb-item" href="#">Technology</a>
                <span class="breadcrumb-item active">News Title</span>
            </nav>
        </div>
    </div> --}}
    <!-- Breadcrumb End -->


    <!-- News With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- News Detail Start -->

                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100 h-100" src="{{ $posts->image ?? '' }}"
                            style="object-fit: cover;height: 350px;">
                        <div class="overlay position-relative bg-light">
                            <h2>{{ $posts->title }}</h2>
                            <div>{{ $posts->categorie->name ?? '' }}</div>
                            <hr>
                            <div>
                                {!! $posts->description ?? '' !!}
                            </div>

                            <div class="mb-3">
                                <span>{{ $posts->created_at ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- News Detail End -->

                    <!-- Comment List Start -->

                    <!-- Comment List End -->

                    <!-- Comment Form Start -->

                    <!-- Comment Form End -->
                </div>

                <div class="col-lg-4 pt-3 pt-lg-0">
                    <!-- Social Follow Start -->

                    <!-- Social Follow End -->

                    <!-- Newsletter Start -->

                    <!-- Newsletter End -->

                    <!-- Ads Start -->

                    <!-- Ads End -->

                    <!-- Popular News Start -->
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
                    <!-- Popular News End -->

                    <!-- Tags Start -->

                    <!-- Tags End -->
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- News With Sidebar End -->
@endsection
