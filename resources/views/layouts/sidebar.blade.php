<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li>
                    <a href="{{ route('admin.home') }}" class="{{ request()->is('admin') ? 'active' : '' }}">
                        <i class="fe-airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('category.index') }}"
                        class="{{ request()->is('admin/category/*') ? 'active' : '' }}">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <span> Category </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tag.index') }}"
                        class="{{ request()->is('admin/tag/*') ? 'active' : '' }}">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <span> Tag </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('post.index') }}"
                        class="{{ request()->is('admin/post/*') ? 'active' : '' }}">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <span> Post </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.index') }}" class="{{ request()->is('admin/admin/*') ? 'active' : '' }}">
                        <i class="fa fa-user"></i>
                        <span> Admin </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-folder-plus"></i>
                        <span> Settings </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('app-settings.index') }}"
                                class="{{ request()->is('admin/settings/app/*') ? 'active' : '' }}">App Settings</a>
                        </li>
                        <li>
                            <a href="{{ route('app-links.index') }}"
                                class="{{ request()->is('admin/settings/app-links/*') ? 'active' : '' }}">App Menu
                                Link
                                Settings</a>
                        </li>
                    </ul>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
