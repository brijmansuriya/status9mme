<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        <li class="dropdown notification-list d-none">
            <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#"
                role="button" aria-haspopup="false" aria-expanded="false">
                <i class="fe-bell noti-icon"></i>
                <span
                    class="badge badge-danger rounded-circle noti-icon-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                <!-- item-->
                <div class="dropdown-item noti-title">
                    <h5 class="m-0">
                        <span class="float-right">
                            <a href="" class="text-dark">
                                111
                            </a>
                        </span>Notification
                    </h5>
                </div>

                <div class="slimscroll noti-scroll">
                    <!-- item-->
                   
                        <a href="#" class="dropdown-item notify-item active">
                            <p class="notify-details">There are no unread notifications</p>
                        </a>
                    <!-- item-->
                    <!-- All-->
                  
                        <a href=""
                            class="dropdown-item text-center text-primary notify-item notify-all">
                            View all
                            <i class="fi-arrow-right"></i>
                        </a>
                </div>



            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown"
                href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ auth()->user()->profile_picture }}"alt="user-image" class="rounded-circle">
                <span class="pro-user-name ml-1">
                    {{ auth()->user()->name }} <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="{{ route('admin.edit', auth()->user('admin')->id) }}" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>My Account</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-settings"></i>
                    <span>Settings</span>
                </a>


                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="javascript:void(0)" class="dropdown-item notify-item" id="logout"><span>Logout</span></a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>

    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="{{ route('web.home') }}" class="logo text-center">
            <span class="logo-lg">
             
                <span class="logo-lg-text-light">{{ config('app.name') }}</span>
            </span>
            <span class="logo-sm">
                 <span class="logo-sm-text-dark">F</span>

            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
            </button>
        </li>
    </ul>
</div>
<!-- end Topbar -->
