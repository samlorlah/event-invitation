
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="wpOceans">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <title> Becoming The Sannis 2023</title>
    <link href="{{ asset('assets/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.transitions.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/odometer-theme-default.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- start page-wrapper -->
    <div class="page-wrapper">
        <!-- start preloader -->
        <div class="preloader">
            <!-- <div class="vertical-centered-box">
                <div class="content">
                    <div class="loader-circle"></div>
                    <div class="loader-line-mask">
                        <div class="loader-line"></div>
                    </div>
                    <img src="assets/images/preloader.png" alt="">
                </div>
            </div> -->
        </div>
        <!-- end preloader -->
        <!-- Start header -->
        <header id="header">
            <div class="wpo-site-header wpo-header-style-1" id="sticky-header">
                <nav class="navigation navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-md-3 col-3 d-lg-none d-block">
                                <div class="mobail-menu">
                                    <button type="button" class="navbar-toggler open-btn">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar first-angle"></span>
                                        <span class="icon-bar middle-angle"></span>
                                        <span class="icon-bar last-angle"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-6 d-lg-block d-none">
                                <!-- <div class="social-info">
                                    <ul>
                                        <li><a href="#"><i class="fi flaticon-facebook-app-symbol"></i></a></li>
                                        <li><a href="#"><i class="fi flaticon-twitter"></i></a></li>
                                        <li><a href="#"><i class="fi flaticon-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fi flaticon-instagram-1"></i></a></li>
                                    </ul>
                                </div> -->
                            </div>
                            <div class="col-md-6 col-6 d-lg-none dl-block">
                                <div class="navbar-header">
                                    <a class="navbar-brand" href="index.html"><img height="120" src="{{ asset('assets/images/logo.png') }}"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-1 col-1">
                                <div id="navbar" class="collapse navbar-collapse navigation-holder">
                                    <button class="menu-close"><i class="ti-close"></i></button>
                                    <ul class="nav navbar-nav mb-2 mb-lg-0">
                                        <li><a href="{{ route('home') }}">Back to Dashboard</a>
                                        </li>
                                    </ul>

                                </div><!-- end of nav-collapse -->
                            </div>
                        </div>
                    </div><!-- end of container -->
                </nav>
            </div>
        </header>
        <!-- end of header -->
        <!-- start of hero -->
        <section class="wpo-portfolio-section-s2 pb-0 section-padding" id="gallery">
          <div class="container">
              <div class="wpo-section-title">
                  <h4>Wedding Memories</h4>
              </div>
              <div class="sortable-gallery">
                  <div class="gallery-filters"></div>
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="portfolio-grids gallery-container clearfix">
                            @foreach($media as $upload)
                              @if($upload->file_type == 'image')
                              <div class="grid">
                                  <div class="img-holder">
                                      <a href="{{ $upload->url }}" class="fancybox"
                                          data-fancybox-group="gall-1">
                                          <img src="{{ $upload->url }}" alt class="img img-responsive">
                                          <div class="hover-content">
                                              <i class="ti-plus"></i>
                                          </div>
                                      </a>
                                  </div>
                              </div>
                              @elseif($upload->file_type == 'video')
                              <video width="500px" height="500px"
                                  controls="controls">
                                  
                                  <source src="{{ $upload->url }}"
                                      type="video/mp4">
                              </video>
                              @endif
                            @endforeach
                          </div>
                      </div>
                  </div>
              </div>
              <div class="my-5">
                {{ $media->links() }}
              </div>

          </div> <!-- end container -->
      </section>
    

        <!-- wpo-site-footer start -->
        <div class="wpo-site-footer text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-image">
                            <a class="logo" href="index.html"><img height="120" src="{{ asset('assets/images/logo.png') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="copyright">
                            <p>© Copyright 2023 | <a href="https://six3tech.com">Six 3 Technologies</a> | All right reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- wpo-site-footer end -->
   
    </div>
    <!-- end of page-wrapper -->

    <!-- All JavaScript files
    ================================================== -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Plugins for this template -->
    <script src="{{ asset('assets/js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dlmenu.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-plugin-collection.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <!-- Custom script for this template -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script>
        Dropzone.options.myDropzone = {};
    </script>
</body>

</html>