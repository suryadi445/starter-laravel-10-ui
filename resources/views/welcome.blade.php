@extends('layouts.frontend.LandingpageLayout')
@section('title', 'Bootstrap | Home Page')
@section('body')
    <!-- SECTION HOME -->
    <section id="home" class="fullheight align-items-center bg-img bg-img-fixed"
        style="background-image: url(assets/images/landing/jam.jpg);">
        <div class="container">
            <div class="row mt-5">
                <div class="col-6 col-xs-12">
                    <div class="slogan">
                        <h1 class="left-to-right play-on-scroll">
                            Bootstrap
                        </h1>
                        <p class="left-to-right play-on-scroll delay-2">
                            Welcome to our Role & Permission Management application powered by Laravel. Our platform offers
                            a comprehensive solution for managing user roles and permissions seamlessly within your Laravel
                            project. With our user-friendly interface and powerful features, you can easily assign roles and
                            permissions, ensuring secure access control for your application. Whether you're a solo
                            developer or part of a team, our application adapts to your needs. Get started today by signing
                            up and exploring the full capabilities of our Laravel-powered role and permission management
                            system. Let's simplify user management together and elevate your Laravel project to the next
                            level!
                        </p>
                        <div class="left-to-right play-on-scroll delay-4">
                            <a href="https://wa.me/6289678468651" target="_blank">
                                <button>
                                    Whatsapp
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION HOME -->
    <!-- SECION ABOUT -->
    <section class="about fullheight align-items-center" id="about">
        <div class="container">
            <div class="row">
                <div class="col-7 h-xs">
                    <img src="assets/images/landing/chair.jpg" alt=""
                        class="fullwidth left-to-right play-on-scroll">
                </div>
                <div class="col-5 col-xs-12 align-items-center">
                    <div class="about-slogan right-to-left play-on-scroll">
                        <span class="primary-color">We</span> create <span class="primary-color">unforgetable </span>
                        memories for <span class="primary-color">you</span>
                        </h3>
                        <p>
                            Introducing PermissionMaster, your solution for seamless permission management with Laravel.
                            Streamline assigning and managing permissions within your Laravel app. Define granular
                            permissions for users, ensuring secure access control. Whether a small project or enterprise
                            app, PermissionMaster scales to your needs. Simplify permission management, focus on building
                            amazing Laravel apps hassle-free. Join us for efficient and hassle-free permission management
                            with Laravel.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECION ABOUT -->
    <!-- FOOD MENU SECTION -->
    <section class="align-items-center bg-img bg-img-fixed" id="food-menu-section"
        style="background-image: url(assets/images/landing/awan.jpg);">
        <div class="container">
            <div class="food-menu">
                <h1>
                    Empowering Authorization with <span class="primary-color">Laravel</span> Permissions!
                </h1>
                <p>
                    Discover the power of Laravel Permissions! From defining user roles to managing access control, Laravel
                    Permissions empowers you to create robust and secure applications with ease. Explore the flexibility and
                    simplicity of Laravel Permissions as you navigate through the intricate landscapes of user
                    authorization. Whether you're crafting a small-scale project or a sprawling enterprise application,
                    Laravel Permissions adapts to your needs seamlessly. Embrace the beauty of efficient permission
                    management with Laravel Permissions and unlock endless possibilities in your application development
                    journey.
                </p>
                <div class="food-category">
                    <div class="zoom play-on-scroll">
                        <button class="active" data-food-type="all">
                            All Journeys
                        </button>
                    </div>
                    <div class="zoom play-on-scroll delay-2">
                        <button data-food-type="salad">
                            Laravel-Based
                        </button>
                    </div>
                    <div class="zoom play-on-scroll delay-4">
                        <button data-food-type="lorem">
                            Laravel Best Practices
                        </button>
                    </div>
                    <div class="zoom play-on-scroll delay-6">
                        <button data-food-type="ipsum">
                            Laravel Ecosystem
                        </button>
                    </div>
                    <div class="zoom play-on-scroll delay-8">
                        <button data-food-type="dolor">
                            Laravel Tutorials
                        </button>
                    </div>
                </div>

                <div class="food-item-wrap all">
                    <div class="food-item salad-type">
                        <div class="item-wrap bottom-up play-on-scroll">
                            <div class="item-img">
                                <div class="img-holder bg-img"
                                    style="background-image: url(assets/images/landing/chair.jpg);">
                                </div>
                            </div>
                            <div class="item-info">
                                <div>
                                    <h3>
                                        Laravel
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="food-item lorem-type">
                        <div class="item-wrap bottom-up play-on-scroll">
                            <div class="item-img">
                                <div class="img-holder bg-img"
                                    style="background-image: url(assets/images/landing/glass.jpg);">
                                </div>
                            </div>
                            <div class="item-info">
                                <div>
                                    <h3>
                                        Bootstrap
                                    </h3>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="food-item ipsum-type">
                        <div class="item-wrap bottom-up play-on-scroll">
                            <div class="item-img">
                                <div class="img-holder bg-img"
                                    style="background-image: url(assets/images/landing/city.jpg);">
                                </div>
                            </div>
                            <div class="item-info">
                                <div>
                                    <h3>
                                        PHP
                                    </h3>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="food-item lorem-type">
                        <div class="item-wrap bottom-up play-on-scroll">
                            <div class="item-img">
                                <div class="img-holder bg-img"
                                    style="background-image: url(assets/images/landing/coffee.jpg);">
                                </div>
                            </div>
                            <div class="item-info">
                                <div>
                                    <h3>
                                        VS Code
                                    </h3>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="food-item dolor-type">
                        <div class="item-wrap bottom-up play-on-scroll">
                            <div class="item-img">
                                <div class="img-holder bg-img"
                                    style="background-image: url(assets/images/landing/lilin.jpg);">
                                </div>
                            </div>
                            <div class="item-info">
                                <div>
                                    <h3>
                                        JQuery
                                    </h3>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="food-item salad-type">
                        <div class="item-wrap bottom-up play-on-scroll">
                            <div class="item-img">
                                <div class="img-holder bg-img"
                                    style="background-image: url(assets/images/landing/mama.jpg);">
                                </div>
                            </div>
                            <div class="item-info">
                                <div>
                                    <h3>
                                        Javascript
                                    </h3>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="food-item lorem-type">
                        <div class="item-wrap bottom-up play-on-scroll">
                            <div class="item-img">
                                <div class="img-holder bg-img"
                                    style="background-image: url(assets/images/landing/mosque.jpg);"></div>
                            </div>
                            <div class="item-info">
                                <div>
                                    <h3>
                                        Laragon
                                    </h3>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="food-item dolor-type">
                        <div class="item-wrap bottom-up play-on-scroll">
                            <div class="item-img">
                                <div class="img-holder bg-img"
                                    style="background-image: url(assets/images/landing/pray.jpg);"></div>
                            </div>
                            <div class="item-info">
                                <div>
                                    <h3>
                                        Fontawesome
                                    </h3>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END FOOD MENU SECTION -->
    <!-- TESTIMONIAL SECTION -->
    <section id="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-4 col-xs-12">
                    <div class="review-wrap zoom play-on-scroll delay-2">
                        <div class="review-content">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, labore nisi non
                                molestias, minus laboriosam nostrum impedit iure facilis odio unde quia ad sunt corrupti
                                dolores ratione voluptatibus quidem explicabo.
                            </p>
                            <div class="review-img bg-img" style="background-image: url(assets/images/landing/river.jpg);">
                            </div>
                        </div>
                        <div class="review-info">
                            <h3>
                                Lorem Ipsum Dolor
                            </h3>
                            <div class="rating">
                                <i class="bx bxs-star"></i>
                                <i class="bx bxs-star"></i>
                                <i class="bx bxs-star"></i>
                                <i class="bx bxs-star"></i>
                                <i class="bx bxs-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-xs-12">
                    <div class="zoom play-on-scroll">
                        <div class="review-wrap active">
                            <div class="review-content">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, labore nisi non
                                    molestias, minus laboriosam nostrum impedit iure facilis odio unde quia ad sunt
                                    corrupti
                                    dolores ratione voluptatibus quidem explicabo.
                                </p>
                                <div class="review-img bg-img"
                                    style="background-image: url(assets/images/landing/robot.jpg);">
                                </div>
                            </div>
                            <div class="review-info">
                                <h3>
                                    Lorem Ipsum Dolor
                                </h3>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-xs-12">
                    <div class="review-wrap zoom play-on-scroll delay-4">
                        <div class="review-content">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, labore nisi non
                                molestias, minus laboriosam nostrum impedit iure facilis odio unde quia ad sunt corrupti
                                dolores ratione voluptatibus quidem explicabo.
                            </p>
                            <div class="review-img bg-img"
                                style="background-image: url(assets/images/landing/sungai.jpg);">
                            </div>
                        </div>
                        <div class="review-info">
                            <h3>
                                Lorem Ipsum Dolor
                            </h3>
                            <div class="rating">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END TESTIMONIAL SECTION -->

@endsection
