
@extends('HomePage.home') <!-- Adjust the path as necessary -->

@section('content')
<!--? slider Area Start-->
    <div class="slider-area position-relative">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-9 col-sm-10">
                        <div class="hero__caption">
                            <span data-animation="fadeInLeft" data-delay=".1s">Committed to a sustainable future</span> <!-- Choisissez votre option ici -->
                            <h1 data-animation="fadeInLeft" data-delay=".5s">Waste Wise</h1>
                            <!-- Hero-btn -->
                            <div class="slider-btns">
                                <a data-animation="fadeInRight" data-delay="1.0s" class="popup-video video-btn" href="https://www.youtube.com/watch?v=6jQ7y_qQYUA"><i class="fas fa-play"></i></a>
                                <p class="video-cap d-none d-sm-blcok" data-animation="fadeInRight" data-delay="1.0s">
                                    Story Video
                                    <br>
                                    Watch
                                </p>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-9 col-sm-10">
                            <div class="hero__caption">
                                <span data-animation="fadeInLeft" data-delay=".1s">Committed to success</span>
                                <h1 data-animation="fadeInLeft" data-delay=".5s">Digital Conference For Designers</h1>
                                <!-- Hero-btn -->
                                <div class="slider-btns">
                                    <a data-animation="fadeInLeft" data-delay="1.0s" href="industries.html" class="btn hero-btn">Download</a>
                                    <a data-animation="fadeInRight" data-delay="1.0s" class="popup-video video-btn"  href="https://www.youtube.com/watch?v=up68UAfH0d0"><i class="fas fa-play"></i></a>
                                    <p class="video-cap d-none d-sm-blcok" data-animation="fadeInRight" data-delay="1.0s">
                                        Story Vidoe
                                        <br>
                                         Watch
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Counter Section Begin -->
        <div class="counter-section d-none d-sm-block">
            <div class="cd-timer" id="countdown" >
                <div class="cd-item">
                    <span>96</span>
                    <p>
                        Days
                    </p>
                </div>
                <div class="cd-item">
                    <span>15</span>
                    <p>
                        Hrs
                    </p>
                </div>
                <div class="cd-item">
                    <span>07</span>
                    <p>
                        Min
                    </p>
                </div>
                <div class="cd-item">
                    <span>02</span>
                    <p>
                        Sec
                    </p>
                </div>
            </div>
        </div>
        <!-- Counter Section End -->
    </div>
    <!-- slider Area End-->
    <!--? About Law Start-->
    <section class="about-low-area section-padding2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="about-caption mb-50">
                    <!-- Section Tittle -->
                    <div class="section-tittle mb-35">
                        <h2>Waste Wise: A Commitment to Sustainability</h2> <!-- Modifié -->
                    </div>
                    <p>
                        Join us in our mission to promote recycling and sustainable practices. Together, we can make a difference for our planet.
                    </p>
                    <p>
                        Learn about innovative solutions and community initiatives that drive positive environmental change.
                    </p>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
                        <div class="single-caption mb-20">
                            <div class="caption-icon">
                                <span class="flaticon-communications-1"></span>
                            </div>
                            <div class="caption">
                                <h5>Where</h5>
                                <p>Online Event</p> <!-- Modifié -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
                        <div class="single-caption mb-20">
                            <div class="caption-icon">
                                <span class="flaticon-education"></span>
                            </div>
                            <div class="caption">
                                <h5>When</h5>
                                <p>Earth Day, April 22, 2024</p> <!-- Modifié -->
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" class="btn mt-50">Join the Movement</a> <!-- Modifié -->
            </div>
            <div class="col-lg-6 col-md-12">
                <!-- about-img -->
                <div class="about-img ">
                    <div class="about-font-img d-none d-lg-block">
                        <img src="{{ asset('LandingPage/assets/img/recycling/3.png') }}" alt="Recycling Image" width="600" height="700">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- About Law End-->

    <!--? accordion -->
    <section class="accordion fix section-padding30">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 col-md-6">
                    <!-- Section Tittle -->
                    <div class="section-tittle text-center mb-80">
    <h2>Recycling Event Schedule</h2> <!-- Titre modifié -->
    <p>
        Join us for a series of informative sessions focused on sustainable practices, recycling initiatives, and community involvement. Explore how you can contribute to a cleaner, greener planet.
    </p>
</div>

                </div>
            </div>
            <div class="row ">
                <div class="col-lg-11">
                    <div class="properties__button mb-40">
                        <!--Nav Button  -->
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Day - 01</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"> Day - 02</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"> Day - 03 </a>
                                <a class="nav-item nav-link" id="nav-dinner-tab" data-toggle="tab" href="#nav-dinner" role="tab" aria-controls="nav-dinner" aria-selected="false"> Day - 04 </a>
                            </div>
                        </nav>
                        <!--End Nav Button  -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- Nav Card -->
            <div class="tab-content" id="nav-tabContent">
                <!-- card one -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        <div class="col-lg-11">
                            <div class="accordion-wrapper">
                                <div class="accordion" id="accordionExample">
                                    <!-- single-one -->
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0">
                                                <a href="#" class="btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    <span>8:30 AM - 9:30 AM</span>
                                                    <p>
                                                        Snackes
                                                    </p>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                There arge many variations ohf passages of sorem gpsum ilable, but the majority have suffered alteration in some form, by ected humour, or randomised words whi.rere arge many variations ohf passages of sorem gpsum ilable.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-two -->
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <span>8:30 AM - 9:30 AM</span>
                                                    <p>
                                                        Opening conference
                                                    </p>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                There arge many variations ohf passages of sorem gpsum ilable, but the majority have suffered alteration in some form, by ected humour, or randomised words whi.rere arge many variations ohf passages of sorem gpsum ilable.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-three -->
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h2 class="mb-0">
                                                <a href="#" class="btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <span>8:30 AM - 9:30 AM</span>
                                                    <p>
                                                        Conference ending
                                                    </p>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                            <div class="card-body">
                                                There arge many variations ohf passages of sorem gpsum ilable, but the majority have suffered alteration in some form, by ected humour, or randomised words whi.rere arge many variations ohf passages of sorem gpsum ilable.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card two -->
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="row">
                        <div class="col-lg-11">
                            <div class="accordion-wrapper">
                                <div class="accordion" id="accordionExample">
                                    <!-- single-one -->
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0">
                                                <a href="#" class="btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                                                    <span>8:30 AM - 9:30 AM</span>
                                                    <p>
                                                        Snackes
                                                    </p>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo2" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                There arge many variations ohf passages of sorem gpsum ilable, but the majority have suffered alteration in some form, by ected humour, or randomised words whi.rere arge many variations ohf passages of sorem gpsum ilable.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-two -->
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                                                    <span>8:30 AM - 9:30 AM</span>
                                                    <p>
                                                        Opening conference
                                                    </p>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapseOne1" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                There arge many variations ohf passages of sorem gpsum ilable, but the majority have suffered alteration in some form, by ected humour, or randomised words whi.rere arge many variations ohf passages of sorem gpsum ilable.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-three -->
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h2 class="mb-0">
                                                <a href="#" class="btn-link collapsed" data-toggle="collapse" data-target="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                                                    <span>8:30 AM - 9:30 AM</span>
                                                    <p>
                                                        Conference ending
                                                    </p>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapseThree3" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                            <div class="card-body">
                                                There arge many variations ohf passages of sorem gpsum ilable, but the majority have suffered alteration in some form, by ected humour, or randomised words whi.rere arge many variations ohf passages of sorem gpsum ilable.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card three -->
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="row">
                        <div class="col-lg-11">
                            <div class="accordion-wrapper">
                                <div class="accordion" id="accordionExample">
                                    <!-- single-one -->
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0">
                                                <a href="#" class="btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo01" aria-expanded="false" aria-controls="collapseTwo01">
                                                    <span>8:30 AM - 9:30 AM</span>
                                                    <p>
                                                        Snackes
                                                    </p>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo01" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                There arge many variations ohf passages of sorem gpsum ilable, but the majority have suffered alteration in some form, by ected humour, or randomised words whi.rere arge many variations ohf passages of sorem gpsum ilable.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-two -->
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne02" aria-expanded="true" aria-controls="collapseOne02">
                                                    <span>8:30 AM - 9:30 AM</span>
                                                    <p>
                                                        Opening conference
                                                    </p>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapseOne02" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                There arge many variations ohf passages of sorem gpsum ilable, but the majority have suffered alteration in some form, by ected humour, or randomised words whi.rere arge many variations ohf passages of sorem gpsum ilable.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-three -->
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h2 class="mb-0">
                                                <a href="#" class="btn-link collapsed" data-toggle="collapse" data-target="#collapseThree03" aria-expanded="false" aria-controls="collapseThree03">
                                                    <span>8:30 AM - 9:30 AM</span>
                                                    <p>
                                                        Conference ending
                                                    </p>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapseThree03" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                            <div class="card-body">
                                                There arge many variations ohf passages of sorem gpsum ilable, but the majority have suffered alteration in some form, by ected humour, or randomised words whi.rere arge many variations ohf passages of sorem gpsum ilable.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card Four -->
                <div class="tab-pane fade" id="nav-dinner" role="tabpanel" aria-labelledby="nav-dinner">
                    <div class="row">
                        <div class="col-lg-11">
                            <div class="accordion-wrapper">
                                <div class="accordion" id="accordionExample">
                                    <!-- single-one -->
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0">
                                                <a href="#" class="btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo10" aria-expanded="false" aria-controls="collapseTwo10">
                                                    <span>8:30 AM - 9:30 AM</span>
                                                    <p>
                                                        Snackes
                                                    </p>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo10" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                There arge many variations ohf passages of sorem gpsum ilable, but the majority have suffered alteration in some form, by ected humour, or randomised words whi.rere arge many variations ohf passages of sorem gpsum ilable.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-two -->
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne20" aria-expanded="true" aria-controls="collapseOne20">
                                                    <span>8:30 AM - 9:30 AM</span>
                                                    <p>
                                                        Opening conference
                                                    </p>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapseOne20" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                There arge many variations ohf passages of sorem gpsum ilable, but the majority have suffered alteration in some form, by ected humour, or randomised words whi.rere arge many variations ohf passages of sorem gpsum ilable.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-three -->
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h2 class="mb-0">
                                                <a href="#" class="btn-link collapsed" data-toggle="collapse" data-target="#collapseThree30" aria-expanded="false" aria-controls="collapseThree30">
                                                    <span>8:30 AM - 9:30 AM</span>
                                                    <p>
                                                        Conference ending
                                                    </p>
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapseThree30" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                            <div class="card-body">
                                                There arge many variations ohf passages of sorem gpsum ilable, but the majority have suffered alteration in some form, by ected humour, or randomised words whi.rere arge many variations ohf passages of sorem gpsum ilable.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Nav Card -->
        </div>
    </section>
    <!-- accordion End -->

    <!--? Brand Area Start-->
    <section class="work-company section-padding30" data-background="{{ asset('LandingPage/assets/img/gallery/7.png')}}">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-8">
                    <!-- Section Tittle -->
                    <div class="section-tittle section-tittle2 mb-50">
                        <h2>Our Top Genaral Sponsors.</h2>
                        <p>
                        We appreciate all organizations and individuals who support us, regardless of sponsorship status.
                        </p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="logo-area">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo mb-30">
                                    <img src="{{ asset('LandingPage/assets/img/gallery/cisco_brand.png')}}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo mb-30">
                                    <img src="{{ asset('LandingPage/assets/img/gallery/cisco_brand2.png')}}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo mb-30">
                                    <img src="{{ asset('LandingPage/assets/img/gallery/cisco_brand3.png')}}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo mb-30">
                                    <img src="{{ asset('LandingPage/assets/img/gallery/cisco_brand4.png')}}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo mb-30">
                                    <img src="{{ asset('LandingPage/assets/img/gallery/cisco_brand5.png')}}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo mb-30">
                                    <img src="{{ asset('LandingPage/assets/img/gallery/cisco_brand6.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Brand Area End-->
  


    
    @endsection
