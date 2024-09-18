    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light px-lg-5">
            <div class="col-12 col-md-8">
                <div class="d-flex justify-content-between">
                    <div class="bg-primary text-white text-center py-2" style="width: 200px;">{{date('d-M-Y')}}</div>
                    {{-- <div class="owl-carousel owl-carousel-1 tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                        style="width: calc(100% - 100px); padding-left: 90px;">
                        <div class="text-truncate"><a class="text-secondary" href="">Labore sit justo amet eos sed, et
                                sanctus dolor diam eos</a></div>
                        <div class="text-truncate"><a class="text-secondary" href="">Gubergren elitr amet eirmod et
                                lorem diam elitr, ut est erat Gubergren elitr amet eirmod et lorem diam elitr, ut est
                                erat</a></div>
                    </div> --}}
                </div>
            </div>
            <div class="col-md-4 text-right d-none d-md-block">
                Monday, January 01, 2045
            </div>
        </div>
        <div class="row align-items-center py-2 px-lg-5">
            <div class="col-lg-4">
                <a href="{{route('web.home')}}" class="navbar-brand d-none d-lg-block">
                    <div class="m-0 display-5 text-uppercase logo"><span class="text-primary">Status</span>9mme</div>
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                {{-- <img class="img-fluid" src="web/img/ads-700x70.jpg" alt=""> --}}
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0 mb-3">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">
            {{-- <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">News</span>Room</h1>
            </a> --}}
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="{{ route('web.home') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('web.aboutus') }}" class="nav-item nav-link {{ request()->is('about-us') ? 'active' : '' }}">About Us</a>
                    <a href="{{ route('web.privacypolicy') }}" class="nav-item nav-link {{ request()->is('privacy-policy') ? 'active' : '' }}">Privacy Policy</a>
                    <a href="{{ route('web.dmca') }}" class="nav-item nav-link {{ request()->is('dmca') ? 'active' : '' }}">DMCA</a>
                    <a href="{{ route('web.contactus') }}" class="nav-item nav-link {{ request()->is('contact-us') ? 'active' : '' }}">Contact Us</a>
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="#" class="dropdown-item">Menu item 1</a>
                            <a href="#" class="dropdown-item">Menu item 2</a>
                            <a href="#" class="dropdown-item">Menu item 3</a>
                        </div>
                    </div> --}}
                   
                </div>
                <!-- <div class="input-group ml-auto" style="width: 100%; max-width: 300px;">
                    <input type="text" class="form-control" placeholder="Keyword">
                    <div class="input-group-append">
                        <button class="input-group-text text-secondary"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div> -->
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Top News Slider Start -->
        {{-- <div class="container-fluid py-3">
            <div class="container">
                <div class="owl-carousel owl-carousel-2 carousel-item-3 position-relative">
                    <div class="d-flex">
                        <img src="img/news-100x100-1.jpg" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                            <a class="text-secondary font-weight-semi-bold" href="">Lorem ipsum dolor sit amet consec adipis
                                elit</a>
                        </div>
                    </div>
                    <div class="d-flex">
                        <img src="img/news-100x100-2.jpg" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                            <a class="text-secondary font-weight-semi-bold" href="">Lorem ipsum dolor sit amet consec adipis
                                elit</a>
                        </div>
                    </div>
                    <div class="d-flex">
                        <img src="img/news-100x100-3.jpg" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                            <a class="text-secondary font-weight-semi-bold" href="">Lorem ipsum dolor sit amet consec adipis
                                elit</a>
                        </div>
                    </div>
                    <div class="d-flex">
                        <img src="img/news-100x100-4.jpg" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                            <a class="text-secondary font-weight-semi-bold" href="">Lorem ipsum dolor sit amet consec adipis
                                elit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    <!-- Top News Slider End -->
