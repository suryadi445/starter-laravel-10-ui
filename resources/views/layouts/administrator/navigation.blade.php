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
                    <i class="fa-solid fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-category">
                <span class="text-uppercase">User Interface</span>
            </li>

            @foreach (getMenus() as $menu)
                @can('read ' . $menu->url)
                    @if ($menu->type_menu == 'parent')
                        <li class="{{ getParentMenus(request()->segment(1)) == $menu->name ? 'active open' : '' }}"> <a
                                href="#" class="main-menu has-dropdown">
                                <i class="{{ $menu->icon }}"></i>
                                <span class="text-capitalize">{{ $menu->name }}</span>
                            </a>
                            <ul class="sub-menu {{ getParentMenus(request()->segment(1)) == $menu->name ? 'expand' : '' }}">
                                @foreach ($menu->subMenus as $submenu)
                                    @can('read ' . $submenu->url)
                                        <li
                                            class="{{ request()->segment(1) == explode('/', $submenu->url)[0] ? 'active' : '' }}">
                                            <a href="{{ url($submenu->url) }}" class="link">
                                                <span class="text-capitalize">
                                                    {{ $submenu->name }}
                                                </span>
                                            </a>
                                        </li>
                                    @endcan
                                @endforeach
                            </ul>
                        </li>
                    @elseif ($menu->type_menu == 'single')
                        <li class="{{ request()->segment(1) == $menu->url ? 'active' : '' }}">
                            <a href="{{ url($menu->url) }}" class="link">
                                <i class="{{ $menu->icon }}"></i>
                                <span class="text-capitalize">{{ $menu->name }}</span>
                            </a>
                        </li>
                    @endif
                @endcan
            @endforeach
        </ul>
    </div>
</nav>
