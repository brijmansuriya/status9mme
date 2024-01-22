@extends('web.layouts.app')


@section('content')
    <!-- Main News Slider Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-9 mb-3">
                    <div class="row">
                        @foreach ($categorys as $categorie)
                            <a href="{{ route('web.categories', [$categorie->slug]) }}">
                                <div class="col-md-3 mb-3">
                                    <div class="d-flex ">
                                        <img src="{{ $categorie->category_image }}"
                                            style="width: 200px;height:200px;object-fit: cover;">
                                    </div>
                                    {{ $categorie->name }}
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
