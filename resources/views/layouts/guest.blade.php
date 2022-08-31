<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

        <!-- Scripts -->
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        <!-- Vendor CSS Files -->
        <link href="{{  asset('vendor/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{  asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{  asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{  asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{  asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{  asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
        <link href="{{  asset('Trumbowyg/dist/ui/trumbowyg.min.css') }}" rel="stylesheet">



        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        
    </head>
    <body>
       
        <!-- ======= Top Bar ======= -->
        <section id="topbar" class="d-flex align-items-center fixed-top topbar-transparent">
            <div class="container-fluid container-xl d-flex align-items-center justify-content-center justify-content-lg-start">
            <i class="bi bi-phone d-flex align-items-center"><span>+1 5589 55488 55</span></i>
            <i class="bi bi-clock ms-4 d-none d-lg-flex align-items-center"><span>Mon-Sat: 11:00 AM - 23:00 PM</span></i>
            </div>

            {{-- For Guest --}}
            @guest
            <a href="{{ route('login') }}#login-form" class="btn-book me-2">Prihlásiť sa</a>
            <a href="{{ route('register') }}#register-form" class="btn-book me-2">Registrovať sa</a>
            @endguest

            {{-- For login user --}}
            @auth
            {{-- If has any role --}}
            @hasanyrole('Manager|Admin|Waiter')
            <a href="{{ route('admin.index') }}#user-reservation" class="btn-book me-2">Nastavenia</a>
            @endhasanyrole

            <a href="{{ route('user.index') }}#user-reservation" class="btn-book me-2">{{ auth()->user()->name }}</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a :href="route('logout')" class="btn-book me-2 text-nowrap"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    Odhlásiť sa
                </a>
            </form>
            @endauth
        </section>

        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top d-flex align-items-center header-transparent">
            <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <div class="logo me-auto">
                <h1><a href="/">{{ config('app.name', 'Laravel') }}</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    @if( Route::current()->getName() == 'reservations.step.one' || 
                         Route::current()->getName() == 'reservations.step.two' || 
                         Route::current()->getName() == 'login' || 
                         Route::current()->getName() == 'register' || 
                         Route::current()->getName() == 'user.index')
                        <li><a class="nav-link" href="/#hero">Domov</a></li>
                        <li><a class="nav-link scrollto" href="/#about">O nás</a></li>
                        <li><a class="nav-link scrollto" href="/#menu">Menu</a></li>
                        <li><a class="nav-link scrollto" href="/#gallery">Galéria</a></li>
                        <li><a class="nav-link scrollto" href="/#contact">Kontakt</a></li>
                    @else
                        <li><a class="nav-link scrollto active" href="#hero">Domov</a></li>
                        <li><a class="nav-link scrollto" href="#about">O nás</a></li>
                        <li><a class="nav-link scrollto" href="#menu">Menu</a></li>
                        <li><a class="nav-link scrollto" href="#gallery">Galéria</a></li>
                        <li><a class="nav-link scrollto" href="#contact">Kontakt</a></li>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <a href="{{ route('reservations.step.one') }}#reservation-step-one" class="book-a-table-btn scrollto">Rezervovať stôl</a>

            </div>
        </header><!-- End Header -->

        <!-- ======= Hero Section ======= -->
        <section id="hero">
            <div class="hero-container">
            <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

                <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

                <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url({{ Storage::url('public/img/slide/slide-1.jpg') }});">
                    <div class="carousel-container">
                    <div class="carousel-content">
                        <h2 class="animate__animated animate__fadeInDown"><span>{{ config('app.name', 'Laravel') }}</span> Restaurant</h2>
                        <p class="animate__animated animate__fadeInUp"></p>
                        <div>
                        @if(Route::current()->getName() == 'reservations.step.two')
                            <a href="/#menu" class="btn-menu animate__animated animate__fadeInUp scrollto">Naše menu</a>
                        @else
                            <a href="#menu" class="btn-menu animate__animated animate__fadeInUp scrollto">Naše menu</a>
                        @endif
                        <a href="{{ route('reservations.step.one') }}#reservation-step-one" class="btn-book animate__animated animate__fadeInUp scrollto">Rezervovať stôl</a>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item" style="background-image: url({{ Storage::url('img/slide/slide-2.jpg') }});">
                    <div class="carousel-container">
                    <div class="carousel-content">
                        <h2 class="animate__animated animate__fadeInDown">Lorem Ipsum Dolor</h2>
                        <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                        <div>
                        @if(Route::current()->getName() == 'reservations.step.two')
                            <a href="/#menu" class="btn-menu animate__animated animate__fadeInUp scrollto">Naše menu</a>
                        @else
                            <a href="#menu" class="btn-menu animate__animated animate__fadeInUp scrollto">Naše menu</a>
                        @endif
                        <a href="{{ route('reservations.step.one') }}#reservation-step-one" class="btn-book animate__animated animate__fadeInUp scrollto">Rezervovať stôl</a>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item" style="background-image: url({{ Storage::url('img/slide/slide-3.jpg') }});">
                    <div class="carousel-container">
                    <div class="carousel-content">
                        <h2 class="animate__animated animate__fadeInDown">Sequi ea ut et est quaerat</h2>
                        <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                        <div>
                        @if(Route::current()->getName() == 'reservations.step.two')
                            <a href="/#menu" class="btn-menu animate__animated animate__fadeInUp scrollto">Naše menu</a>
                        @else
                            <a href="#menu" class="btn-menu animate__animated animate__fadeInUp scrollto">Naše menu</a>
                        @endif
                        <a href="{{ route('reservations.step.one') }}#reservation-step-one" class="btn-book animate__animated animate__fadeInUp scrollto">Rezervovať stôl</a>
                        </div>
                    </div>
                    </div>
                </div>

                </div>

                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>

            </div>
            </div>
        </section><!-- End Hero -->

        @if ($errors->any())
            <div class="alert alert-danger col-8 m-auto mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
                        <div class="alert alert-success col-10 m-auto" id="status" role="alert">
                            {{ session('status') }} 
                        </div>
        @endif
        @if (session()->has('info'))
            <div id="flash-message" class="alert alert-{{ session('type')}} col-8 m-auto mt-3">
                <p>
                    {{session('info')}}
                </p>
            </div>
        @endif
        

  
        <!-- ======= Main ======= -->
        <main id="main">
                
            {{ $slot }}
                
        </main><!-- End #main -->
        

        <!-- ======= Footer ======= -->
        <footer id="footer">
            <div class="container">
            <h3>Delicious</h3>
            <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
            <div class="social-links">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
            <div class="copyright">
                &copy; Copyright <strong><span>Delicious</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/delicious-free-restaurant-bootstrap-theme/ -->
                Designed by <a href="">Papučko Ečka</a>
            </div>
            </div>
        </footer><!-- End Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <img src="/storage/loader.gif" alt="loader" id="loader" class="d-none" style="width: 4rem;position: fixed; z-index: 10; left: 46%; top: 35%">

        <!-- Vendor JS Files -->
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('vendor/glightbox/js/glightbox.min.js')}}"></script>
        <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
        <script src="{{ asset('vendor/swiper/swiper-bundle.min.js')}}"></script>

        <!-- Template Main JS File -->
        
        <script src="{{ asset('js/main.js') }}" defer></script>

        {{-- My JS File --}}
        <script src="{{ asset('js/jquery.js') }}" defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('Trumbowyg/dist/trumbowyg.min.js') }}" defer></script>
        <script src="{{ asset('js/my.js') }}" defer></script>

    </body>
</html>
