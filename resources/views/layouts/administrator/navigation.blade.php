<nav class="main-sidebar ps-menu">
    <div class="sidebar-header">
        <div class="text">Administrator</div>
        <div class="close-sidebar action-toggle">
            <i class="ti-close"></i>
        </div>
    </div>
    <div class="sidebar-content">
        <ul>
            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="link">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-category">
                <span class="text-uppercase">User Interface</span>
            </li>
            @can('read konfigurasi')
                <li class="{{ request()->segment(1) == 'kofigurasi' ? 'active open' : '' }}">
                    <a href="#" class="main-menu has-dropdown">
                        <i class="ti-desktop"></i>
                        <span>Konfigurasi</span>
                    </a>
                    <ul class="sub-menu {{ request()->segment(1) == 'kofigurasi' ? 'expand' : '' }}">
                        @can('read role')
                            <li
                                class="{{ request()->segment(1) == 'kofigurasi' && request()->segment(2) == 'roles' ? 'active' : '' }}">
                                <a href="{{ route('roles.index') }}" class="link">
                                    <span>Roles</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </div>
</nav>
