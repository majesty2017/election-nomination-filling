@extends('defaults.master')

@section('title', 'ELECT-EYE (HTU)')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="row">
                    <div class="col-xl-5">
                        <h1><center>WELCOME TO @yield('title')</center></h1> <br>
                        <h2>We are team of talented designers making websites with Bootstrap</h2>
                    </div>

                    <!-- slide show with carousel -->
                    <div class="container-fluid" data-aos="zoom-in">
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <div class="owl-carousel clients-carousel">
                                    <img src="{{ asset('assets/img/clients/client-1.jpg') }}" alt="client-1">
                                    <img src="{{ asset('assets/img/clients/client-2.jpg') }}" alt="">
                                    <img src="{{ asset('assets/img/clients/client-3.png') }}" alt="">
                                    <img src="{{ asset('assets/img/clients/client-4.png') }}" alt="">
                                    <img src="{{ asset('assets/img/clients/client-5.png') }}" alt="">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- End Hero -->

        <div id="intro">
            <div class="intro-text">
                <div class="container">

                    <!-- <div id="rotator">
                      <h1 class="1strotate">Ghana</h1>
                      <h1 class="2ndrotate">country</h1>

                    </div> -->
                </div>
            </div>
        </div>

        <main id="main">

            <!-- ======= Clients Section ======= -->
            <!-- <section id="clients" class="clients">
               <div class="container-fluid" data-aos="zoom-out">
                 <div class="row justify-content-center">
                   <div class="col-xl-10">
                     <div class="owl-carousel clients-carousel">
                       <img src="{{ asset('assets/img/clients/client-1.jpg') }}" alt="client-1">
                       <img src="{{ asset('assets/img/clients/client-2.jpg') }}" alt="">
                       <img src="{{ asset('assets/img/clients/client-3.png') }}" alt="">
                       <img src="{{ asset('assets/img/clients/client-4.png') }}" alt="">
                       <img src="{{ asset('assets/img/clients/client-5.png') }}" alt="">
                       <img src="{{ asset('assets/img/clients/client-6.png') }}" alt="">
                       <img src="{{ asset('assets/img/clients/client-7.png') }}" alt="">
                       <img src="{{ asset('assets/img/clients/client-8.png') }}" alt="">
                     </div>
                   </div>
                 </div>
               </div>  -->
            <!-- </section> End Clients Section -->



            <!-- ======= Counts Section ======= -->
            <!--  <section id="counts" class="counts">
                <div class="container" data-aos="fade-up">

                  <div class="row">

                    <div class="col-lg-3 col-md-6">
                      <div class="count-box">
                        <i class="icofont-simple-smile"></i>
                        <span data-toggle="counter-up">232</span>
                        <p>Happy Clients</p>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                      <div class="count-box">
                        <i class="icofont-document-folder"></i>
                        <span data-toggle="counter-up">521</span>
                        <p>Projects</p>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                      <div class="count-box">
                        <i class="icofont-live-support"></i>
                        <span data-toggle="counter-up">1,463</span>
                        <p>Hours Of Support</p>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                      <div class="count-box">
                        <i class="icofont-users-alt-5"></i>
                        <span data-toggle="counter-up">15</span>
                        <p>Hard Workers</p>
                      </div>
                    </div>

                  </div>

                </div>  -->
        </main><!-- End #main -->
    </section><!-- End Counts Section -->
@endsection