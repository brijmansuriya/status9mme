@extends('web.layouts.app')
@section('css')
    {!! seo()->for($post) !!}
    <meta property="article:published_time" content="{{ $post->created_at->toIso8601String() }}" />
    <meta property="article:modified_time" content="{{ $post->updated_at->toIso8601String() }}" />
@endsection
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="container">
            <nav class="breadcrumb bg-transparent m-0 p-0">
                <a class="breadcrumb-item" href="{{ route('web.home') }}">Home</a>

                @if ($post?->categorie?->slug && $post?->categorie?->name)
                    <a class="breadcrumb-item"
                        href="{{ route('web.categories', ['slug' => $post->categorie->slug]) }}">{{ $post?->categorie?->name }}</a>
                @endif

                <span class="breadcrumb-item active">{{ Str::limit($post->title, 50, '...') }}</span>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- News With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- News Detail Start -->

                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100 h-50" src="{{ $post->image ?? '' }}"
                            style="object-fit: cover;height: 350px;" alt="{{ $post->title }}">



                        <div class="overlay position-relative bg-light">
                            <h1>{{ $post->title }}</h1>
                            <div>{{ $post->categorie->name ?? '' }}</div>
                            <hr>
                            <div>
                                {!! $post->description ?? '' !!}
                            </div>

                            <div class="mb-3">
                                <span>{{ $post->created_at ?? '' }}</span>
                            </div>


                            <x-web.tools.share-buttons url="url()->current()" text="Check out this amazing post!" />

                            <a href="{{ $post->url }}?view_as=subscriber" class="my-3 text-center">
                                <<< GO TO YOUTUBE>>>
                            </a>


                            {{-- ifrem using pakeg --}}
                            <div class="embed-responsive embed-responsive-16by9">
                                @youtube($post->url)
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
                                            <div class="h6 m-0">{{ Str::limit($tranding->title, 70, '...') }}</div>
                                        </div>
                                        <span>{{ $tranding->created_at }}</span>


                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                    <!-- Popular News End -->

                    <!-- Tags Start -->
                    {{-- <div class="mb-5">
                        <h4 class="font-weight-semi-bold mb-4">Tags</h4>
                        <div class="d-flex flex-wrap m-n1">
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('web.tag', ['slug' => $tag->slug]) }}" 
                                    class="btn btn-sm btn-outline-secondary m-1">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div> --}}
                    <!-- Tags End -->
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- News With Sidebar End -->
@endsection

@section('script')
    {{-- JSON-LD for Breadcrumb Schema --}}
    @php
        $breadcrumbs = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => route('web.home'),
            ],
        ];

        if ($post?->categorie?->slug && $post?->categorie?->name) {
            $breadcrumbs[] = [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $post->categorie->name,
                'item' => route('web.categories', ['slug' => $post->categorie->slug]),
            ];
        }

        $breadcrumbs[] = [
            '@type' => 'ListItem',
            'position' => count($breadcrumbs) + 1,
            'name' => Str::limit($post->title, 50, '...'),
        ];

    @endphp

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": {!! json_encode($breadcrumbs) !!}
    }
</script>
@endsection
