<!-- Footer Start -->
<div class="container-fluid bg-light pt-5 px-sm-3 px-md-5">
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-5">
            <a href="{{ route('web.home') }}" class="navbar-brand">
                <div class="mb-2 mt-n2 display-5 text-uppercase logo"><span class="text-primary">STATUS</span>9MME</div>
            </a>
            <p>Old stories and and videos for knowledge for history</p>
            <div class="d-flex justify-content-start mt-4">
                <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;"
                    href="https://twitter.com/status9mme"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;"
                    href="https://www.facebook.com/status9mme/"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;"
                    href="https://www.linkedin.com/in/raj-kota-8a4a191a2/"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;"
                    href="https://www.instagram.com/htmlvscss/"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;"
                    href="https://www.youtube.com/channel/UCWqgqZyrxjBjFk08mu5KihQ"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="font-weight-bold mb-4">Categories</h4>
            <div class="d-flex flex-wrap m-n1">
                @foreach ($categorys as $categorie)
                    <a href="{{ route('web.categories', [$categorie->slug]) }}"
                        class="btn btn-sm btn-outline-secondary m-1">{{ $categorie->name }}</a>
                @endforeach
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="font-weight-bold mb-4">Tools</h4>
            <div class="d-flex flex-wrap m-n1">
                @foreach (config('app.tools') as $tool)
                    <a href="{{ $tool['route'] }}" 
                        class="btn btn-sm btn-outline-secondary m-1">{{ $tool['name'] }}</a>
                @endforeach
            </div>
        </div>
        {{-- <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="font-weight-bold mb-4">Tags</h4>
            <div class="d-flex flex-wrap m-n1">
                @foreach ($tags as $tag)
                <a href="" class="btn btn-sm btn-outline-secondary m-1">{{$tag->name}}</a>
                @endforeach
            </div>
        </div> --}}
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="font-weight-bold mb-4">Quick Links</h4>
            <div class="d-flex flex-column justify-content-start">
                <a class="text-secondary mb-2" href="{{ route('web.aboutus') }}">
                    <i class="fa fa-angle-right text-dark mr-2"></i>
                    About
                </a>
                <a class="text-secondary mb-2" href="{{ route('web.privacypolicy') }}">
                    <i class="fa fa-angle-right text-dark mr-2"></i>
                    Privacy Policy
                </a>
                <a class="text-secondary mb-2" href="{{ route('web.dmca') }}">
                    <i class="fa fa-angle-right text-dark mr-2"></i>
                    DMCA
                </a>
                <a class="text-secondary" href="{{ route('web.contactus') }}">
                    <i class="fa fa-angle-right text-dark mr-2"></i>
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4 px-sm-3 px-md-5">
    <p class="m-0 text-center">
        &copy; <a class="font-weight-bold" href="#">STATUS9MME</a>. All Rights Reserved.
        Designed by <a class="font-weight-bold" href="https://htmlcodex.com">STATUS9MME</a>
    </p>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-dark back-to-top"><i class="fa fa-angle-up"></i></a>
