<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Gymnast - Gym Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="{{ asset('frontend/lib/flaticon/font/flaticon.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/css/style.min.css') }}" rel="stylesheet">
</head>
<body class="bg-white">
    <!-- Navbar Start -->
    @include('frontend.layouts.navbar')
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h4 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase font-weight-bold">Our Features</h4>
            <div class="d-inline-flex">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Our Features</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


     <!-- GYM Feature Start -->
     <div class="container feature pt-5">
        <div class="d-flex flex-column text-center mb-5">
            <h4 class="text-primary font-weight-bold">Why Choose Us?</h4>
            <h4 class="display-4 font-weight-bold">Benifits of Joining Our GYM</h4>
        </div>
        <div class="row">
            <div class="col-md-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0"  src="{{ asset('frontend/img/feature-1.jpg')}}" alt="Image">
                        <i class="flaticon-barbell"></i>
                    </div>
                    <div class="col-sm-7">
                        <h4 class="font-weight-bold">Videos Instruction</h4>
                        <p>Sit lorem ipsum et diam elitr est dolor sed duo. Guberg sea et et lorem dolor sed est sit invidunt, dolore tempor diam ipsum takima  erat tempor</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0"  src="{{ asset('frontend/img/feature-2.jpg')}}" alt="Image">
                        <i class="flaticon-training"></i>
                    </div>
                    <div class="col-sm-7">
                        <h4 class="font-weight-bold">Training Calendar</h4>
                        <p>Sit lorem ipsum et diam elitr est dolor sed duo. Guberg sea et et lorem dolor sed est sit invidunt, dolore tempor diam ipsum takima  erat tempor</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0"  src="{{ asset('frontend/img/feature-3.jpg')}}" alt="Image">
                        <i class="flaticon-trends"></i>
                    </div>
                    <div class="col-sm-7">
                        <h4 class="font-weight-bold">Free Apps & WiFi</h4>
                        <p>Sit lorem ipsum et diam elitr est dolor sed duo. Guberg sea et et lorem dolor sed est sit invidunt, dolore tempor diam ipsum takima  erat tempor</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0"  src="{{ asset('frontend/img/feature-4.jpg')}}"  alt="Image">
                        <i class="flaticon-support"></i>
                    </div>
                    <div class="col-sm-7">
                        <h4 class="font-weight-bold">Community Support</h4>
                        <p>Sit lorem ipsum et diam elitr est dolor sed duo. Guberg sea et et lorem dolor sed est sit invidunt, dolore tempor diam ipsum takima  erat tempor</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- GYM Feature End -->


    <!-- Testimonial Start -->
    <div class="container-fluid position-relative testimonial mt-5" style="margin-bottom: 90px;">
        <div class="container">
            <div class="row px-3 align-items-center">
                <div class="col-md-6 bg-secondary">
                    <div class="d-flex align-items-center px-3" style="min-height: 450px;">
                        <div id="carouselId" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselId" data-slide-to="1"></li>
                                <li data-target="#carouselId" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <div class="d-flex align-items-center mb-4 text-white">
                                        <img width="80" height="80" class="rounded-circle bg-dark p-2" src="img/testimonial-1.jpg"
                                            alt="Image">
                                        <div class="pl-4">
                                            <h4 class="text-primary">Client Name</h4>
                                            <p class="m-0">Profession</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-text position-relative border bg-dark text-white mb-5 p-4">
                                        Sed ea amet kasd elitr stet nonumy, stet rebum et ipsum est duo elitr eirmod clita
                                        lorem. Dolores tempor voluptua ipsum sanctus clita
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="d-flex align-items-center mb-4 text-white">
                                        <img width="80" height="80" class="rounded-circle bg-dark p-2" src="img/testimonial-2.jpg"
                                            alt="Image">
                                        <div class="pl-4">
                                            <h4 class="text-primary">Client Name</h4>
                                            <p class="m-0">Profession</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-text position-relative border bg-dark text-white mb-5 p-4">
                                        Sed ea amet kasd elitr stet nonumy, stet rebum et ipsum est duo elitr eirmod clita
                                        lorem. Dolores tempor voluptua ipsum sanctus clita
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="d-flex align-items-center mb-4 text-white">
                                        <img width="80" height="80" class="rounded-circle bg-dark p-2" src="img/testimonial-3.jpg"
                                            alt="Image">
                                        <div class="pl-4">
                                            <h4 class="text-primary">Client Name</h4>
                                            <p class="m-0">Profession</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-text position-relative border bg-dark text-white mb-5 p-4">
                                        Sed ea amet kasd elitr stet nonumy, stet rebum et ipsum est duo elitr eirmod clita
                                        lorem. Dolores tempor voluptua ipsum sanctus clita
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="pl-md-3 d-none d-md-block">
                        <h4 class="text-primary">Testimonial</h4>
                        <h4 class="display-4 mb-4 text-white font-weight-bold">What Our Clients Say?</h4>
                        <p class="m-0 text-white">Vero elitr lorem magna justo magna justo at justo est ipsum sed clita
                            lorem dolor ipsum sed. Lorem sea lorem vero. Sanct dolor clita clita rebum kasd magna erat diam
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    @include('frontend.layouts.footer')
    <!-- Footer End -->



</body>

</html>