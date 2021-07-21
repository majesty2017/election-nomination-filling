<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-10 d-flex align-items-center">
                <h1 class="logo mr-auto"><a href="{{ route('index') }}"><img src= "{{ asset('assets/img/ELECT_EYE 3.png')}}"> <span></span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt=""></a>-->

                <nav class="nav-menu d-none d-lg-block">
                    <ul>
                        <li ><a href="{{ route('index') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('login') }}">Login / Registration</a></li>
                        <li><a href="{{ route('web-portfolio') }}">Portfolio</a></li>
                        <li><a href="{{ route('team') }}">Team</a></li>
                        <!-- <li><a href="blog.html">Blog</a></li>-->
                        <li class="drop-down"><a href="{{ route('history') }}">History</a>
                            <ul>
                                <li><a href="{{ route('history') }}">Current</a></li>
                                <!--  <li class="drop-down"><a href="#">Deep Drop Down</a>
                                    <ul>
                                      <li><a href="#">Deep Drop Down 1</a></li>
                                      <li><a href="#">Deep Drop Down 2</a></li>
                                      <li><a href="#">Deep Drop Down 3</a></li>
                                      <li><a href="#">Deep Drop Down 4</a></li>
                                      <li><a href="#">Deep Drop Down 5</a></li>
                                    </ul>
                                  </li>  -->

                                <li><a href="#">2019</a></li>
                                <li><a href="#">2018</a></li>
                                <li><a href="#">2017</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav><!-- .nav-menu -->

                <!--  <a href="#about" class="get-started-btn scrollto">Get Started</a> -->
            </div>
        </div>

    </div>
</header><!-- End Header -->