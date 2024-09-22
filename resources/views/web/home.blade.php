@extends('web.layouts.app')
@section('css')
    {!! seo($SEOData) !!}
@endsection
@section('meta')
<meta content="Radhe Krishna, Gita quotes in Hindi, Shiva quotes in Hindi, YouTube videos, devotional quotes, Bhagavad Gita, Lord Shiva, spiritual quotes in Hindi" name="keywords">

@endsection
@section('content')
    <!-- Main News Slider Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">
                        <div class="position-relative overflow-hidden" style="height: 435px;">
                            <img class="img-fluid h-100" src="web/img/status9mme-banner-1.webp" style="object-fit: cover;">
                        </div>
                        <div class="position-relative overflow-hidden" style="height: 435px;">
                            <img class="img-fluid h-100" src="web/img/status9mme-banner-2.webp" style="object-fit: cover;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Categories</h3>
                        <a class="text-secondary font-weight-medium text-decoration-none"
                            href="{{ route('web.categorieslist') }}">View All</a>
                    </div>
                    @foreach ($categorys as $categorie)
                        <div class="position-relative overflow-hidden mb-3" style="height: 80px;">

                            <a href="{{ route('web.categories', [$categorie->slug]) }}"
                                class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">{{ $categorie->name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Main News Slider End -->




    <!-- Featured News Slider Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                <h3 class="m-0">Featured</h3>
            </div>
            <div class="owl-carousel owl-carousel-2 carousel-item-4 position-relative">
                @foreach ($featureds as $featured)
                    <a href="{{ route('web.popularpost', ['slug' => $featured->slug]) }}">
                        <div class="position-relative overflow-hidden" style="height: 300px;">
                            <img class="img-fluid w-100 h-100" src="{{ $featured->image }}" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-1" style="font-size: 13px;">
                                    <div class="text-white">{{ $featured->created_at }}</div>
                                </div>
                                <div class="h4 m-0 text-white">
                                    {{ Str::limit($featured->title, 15, '...') }}
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- News With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">Popular</h3>
                                <a class="text-secondary font-weight-medium text-decoration-none"
                                    href="{{ route('web.allpopularpostlist') }}">View All</a>
                            </div>
                        </div>
                        @foreach ($populars as $popular)
                            <div class="col-lg-6">
                                <a class="h4" href="{{ route('web.popularpost', ['slug' => $popular->slug]) }}">
                                    <div class="position-relative mb-3">
                                        <img class="img-fluid w-100 h-200" src="{{ $popular->image }}"
                                            style="object-fit: cover;">
                                        <div class="overlay position-relative bg-light">
                                            <div class="mb-2" style="font-size: 14px;">
                                                <div>{{ $popular->categorie->name ?? '' }}</div>
                                            </div>
                                            <div class="h4">
                                                {{ Str::limit($popular->title, 35, '...') }}
                                            </div>
                                            <div class="h6">{{ $popular->created_at }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">Latest</h3>
                                <a class="text-secondary font-weight-medium text-decoration-none"
                                    href="{{ route('web.alllatestpostlist') }}">View All</a>
                            </div>
                        </div>
                        @foreach ($latests as $latest)
                            <div class="col-lg-6">
                                <a class="h4" href="{{ route('web.popularpost', ['slug' => $latest->slug]) }}">
                                    <div class="position-relative mb-3">
                                        <img class="img-fluid w-100 h-200" src="{{ $latest->image }}"
                                            style="object-fit: cover;">
                                        <div class="overlay position-relative bg-light">
                                            <div class="mb-2" style="font-size: 14px;">
                                                <div>{{ $latest->categorie->name ?? '' }}</div>
                                            </div>
                                            <div class="h4">
                                                {{ Str::limit($latest->title, 35, '...') }}
                                            </div>
                                            <div class="h6">{{ $latest->created_at }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    {{-- <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">Latest Explorer</h3>
                                <a class="text-secondary font-weight-medium text-decoration-none"
                                    href="{{ route('web.alllatestpostlist') }}">View All</a>
                            </div>
                        </div>
                        @foreach ($explorers as $explorer)
                            <div class="col-lg-6">
                                <a class="h4" href="{{ route('web.exploer.show', ['slug' => $explorer->slug]) }}">
                                    <div class="position-relative mb-3">
                                        <img class="img-fluid w-100 h-200" src="{{ $explorer->image }}"
                                            style="object-fit: cover;">
                                        <div class="overlay position-relative bg-light">
                                            <div class="mb-2" style="font-size: 14px;">
                                                <div>{{ $explorer->categorie->name ?? '' }}</div>
                                            </div>
                                            <div class="h4">
                                                {{ Str::limit($explorer->title, 35, '...') }}
                                            </div>
                                            <div class="h6">{{ $explorer->created_at }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div> --}}
                </div>

                <div class="col-lg-4 pt-3 pt-lg-0">
                    <!-- Social Follow Start -->


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
                                            <div>
                                                {{ $tranding->categorie->name ?? '' }}
                                            </div>
                                        </div>
                                        <div class="h6 m-0">{{ $tranding->title }}</div>
                                        <span>{{ $tranding->created_at }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                    <!-- Popular News End -->

                    <!-- Tags Start -->
                    {{-- <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Tags</h3>
                        </div>
                        <div class="d-flex flex-wrap m-n1">
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Politics</a>
                            </div>
                    </div> --}}
                    <!-- Tags End -->
                </div>
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->
@endsection

@section('script')
    <script type="application/ld+json">
        {!! $homePageSchema->toScript() !!}
    </script>
@endsection