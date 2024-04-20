<!-- MOBILE NAV -->
<div class="mb-nav">
    <div class="mb-move-item"></div>
    <div class="mb-nav-item active">
        <a href="#home">
            <i class="bx bxs-home"></i>
        </a>
    </div>
    <div class="mb-nav-item">
        <a href="#about">
            <i class='bx bxs-wink-smile'></i>
        </a>
    </div>
    <div class="mb-nav-item">
        <a href="#food-menu-section">
            <i class='bx bxs-food-menu'></i>
        </a>
    </div>
    <div class="mb-nav-item">
        <a href="#testimonial">
            <i class='bx bxs-comment-detail'></i>
        </a>
    </div>
</div>
<!-- END MOBILE NAV -->
<!-- BACK TO TOP BTN -->
<a href="#home" class="back-to-top">
    <i class="bx bxs-to-top"></i>
</a>
<!-- END BACK TO TOP BTN -->
<!-- TOP NAVIGATION -->
<div class="nav">
    <div class="menu-wrap">
        <a href="#home">
            <div class="logo">
                Bootstrap
            </div>
        </a>

        @auth
            <div class="menu h-xs">
                <a href="#home">
                    <div class="menu-item active">
                        Home
                    </div>
                </a>
                <a href="#about">
                    <div class="menu-item">
                        About
                    </div>
                </a>
                <a href="#food-menu-section">
                    <div class="menu-item">
                        Tours
                    </div>
                </a>
                <a href="#testimonial">
                    <div class="menu-item">
                        Testimonials
                    </div>
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="menu-item">
                        Logout
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            @else
                <a href="{{ route('login') }}">
                    <div class="menu-item">
                        Sign In
                    </div>
                </a>
                <a href="{{ route('register') }}">
                    <div class="menu-item">
                        Sign up
                    </div>
                </a>
            @endauth
        </div>

    </div>
</div>
<!-- END TOP NAVIGATION -->
