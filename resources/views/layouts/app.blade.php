<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MedicalCenter</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset ('img/favicon.ico')}}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset ('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset ('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset ('css/slicknav.css')}}">
    <link rel="stylesheet" href="{{asset ('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset ('css/gijgo.css')}}">
    <link rel="stylesheet" href="{{asset ('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset ('css/animated-headline.css')}}">
    @stack('pcss')
    <link rel="stylesheet" href="{{asset ('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset ('css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset ('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset ('css/slick.css')}}">
    <link rel="stylesheet" href="{{asset ('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset ('css/style.css')}}">
</head>

<body>

    <body>
        <!-- ? Preloader Start -->
        <div id="preloader-active">
            <div class="preloader d-flex align-items-center justify-content-center">
                <div class="preloader-inner position-relative">
                    <div class="preloader-circle"></div>
                    <div class="preloader-img pere-text">
                        <img src="{{asset ('img/logo/loder.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <header>
            <!--? Header Start -->
            <div class="header-area">
                <div class="main-header header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2 col-md-1">
                                <div class="logo">
                                    <a href="#"><img src="{{asset('img//logo/logo.png')}}" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-md-10">
                                <div class="menu-main d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu f-right d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">
                                                <li><a href="{{route('home')}}">Home</a></li>
                                                <li><a href="{{route('patient_about')}}">About</a></li>
                                                <li><a href="{{route('patient_doctor')}}">Doctors</a></li>
                                                <li><a
                                                        href="{{ route('patient_appointment', ['id' => Auth::user()->id]) }}">Appointment</a>
                                                </li>
                                                <li>
                                                    <form action="{{route('logout')}}" class="logout" method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to logout?')"
                                                            class="btn_logout">Logout</button>
                                                    </form>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="{{ route('p_settings') }}">
                                                        {{ Auth::user()->name ?? 'Guest' }}
                                                        <img src="{{ asset(Auth::user()->image ?? asset('img\gallery\section_bg01.png')) }}"
                                                            alt="User Image" class="user-image"
                                                            style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                                                    </a>
                                                </li>

                                            </ul>
                                        </nav>
                                    </div>

                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header End -->
        </header>





        @yield('content')






        <footer>
            <!--? Footer Start-->
            <div class="footer-area section-bg" data-background="{{asset('img/gallery/footer_bg.jpg')}}">
                <div class="container">
                    <div class="footer-top footer-padding">
                        <div class="row d-flex justify-content-between">
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-8">
                                <div class="single-footer-caption mb-50">
                                    <!-- logo -->
                                    <div class="footer-logo">
                                        <a href="#"><img src="{{asset('img/logo/logo2_footer.png')}}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-5">
                                <div class="single-footer-caption mb-50">
                                    <div class="footer-tittle">
                                        <h4>About Us</h4>
                                        <div class="footer-pera">
                                            <p class="info1">Lorem igpsum doldfor sit amet, adipiscing elit, sed do
                                                eiusmod
                                                tempor cergelit rgh. </p>
                                            <p class="info1">Lorem ipsum dolor sit amet, adipiscing elit.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-8">
                                <div class="single-footer-caption mb-50">
                                    <div class="footer-number mb-50">
                                        <h4><span>+20 </span>1115849833</h4>
                                        <p>Mazenhelal343@gmail.com</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-bottom">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-xl-9 col-lg-8">
                                <div class="footer-copy-right">
                                    <p>
                                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                        Copyright &copy;<script>
                                            document.write(new Date().getFullYear());
                                        </script> All rights reserved | This template is made with <i
                                            class="fa fa-heart" aria-hidden="true"></i> by <a href="#"
                                            target="_blank">Mazen_Mohamed</a>
                                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4">
                                <!-- Footer Social -->
                                <div class="footer-social f-right">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fas fa-globe"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End-->
        </footer>
        <!-- Scroll Up -->
        <div id="back-top">
            <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
        </div>

        <!-- JS here -->

        <script src="{{asset ('js/vendor/modernizr-3.5.0.min.js')}}"></script>
        <!-- Jquery, Popper, Bootstrap -->
        <script src="{{asset ('js/vendor/jquery-1.12.4.min.js')}}"></script>
        <script src="{{asset ('js/popper.min.js')}}"></script>
        <script src="{{asset ('js/bootstrap.min.js')}}"></script>
        <!-- Jquery Mobile Menu -->
        <script src="{{asset ('js/jquery.slicknav.min.js')}}"></script>

        <!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="{{asset ('js/owl.carousel.min.js')}}"></script>
        <script src="{{asset ('js/slick.min.js')}}"></script>
        <!-- One Page, Animated-HeadLin -->
        <script src="{{asset ('js/wow.min.js')}}"></script>
        <script src="{{asset ('js/animated.headline.js')}}"></script>
        <script src="{{asset ('js/jquery.magnific-popup.js')}}"></script>

        <!-- Date Picker -->
        <script src="{{asset ('js/gijgo.min.js')}}"></script>
        <!-- Nice-select, sticky -->
        <script src="{{asset ('js/jquery.nice-select.min.js')}}"></script>
        <script src="{{asset ('js/jquery.sticky.js')}}"></script>

        <!-- counter , waypoint -->
        <script src="{{asset ('js/jquery.counterup.min.js')}}"></script>
        <script src="{{asset ('js/waypoints.min.js')}}"></script>
        <script src="{{asset ('js/jquery.countdown.min.js')}}"></script>
        <!-- contact js -->
        <script src="{{asset ('js/contact.js')}}"></script>
        <script src="{{asset ('js/jquery.form.js')}}"></script>
        <script src="{{asset ('js/jquery.validate.min.js')}}"></script>
        <script src="{{asset ('js/mail-script.js')}}"></script>
        <script src="{{asset ('js/jquery.ajaxchimp.min.js')}}"></script>

        <!-- Jquery Plugins, main Jquery -->
        <script src="{{asset ('js/plugins.js')}}"></script>
        <script src="{{asset ('js/main.js')}}"></script>

    </body>

</html>