<html lang="en">
<head>
    <meta charset="utf-8" />

    <!--====== Title ======-->
    <title>Mentari Pagi Engineering</title>

    <meta name="description" content="Perusahaan yang bergerak di bidang Steel Custom Fabrication dan ditunjang dengan fasilitas dan peralatan mesin yang memadai serta didukung dengan SDM yang handal, terampil, professional dan bersertifikat." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="https://mentaripagiengineering.co.id/assets/img/icons/favicon.ico" type="image/png" />

    <!--====== CSS Files LinkUp ======-->
    <link rel="stylesheet" href="https://mentaripagiengineering.co.id/assets/template-2/css/animate.css" />
    <link rel="stylesheet" href="https://mentaripagiengineering.co.id/assets/template-2/css/glightbox.min.css" />
    <link rel="stylesheet" href="https://mentaripagiengineering.co.id/assets/template-2/css/lineIcons.css" />
    <link rel="stylesheet" href="https://mentaripagiengineering.co.id/assets/template-2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://mentaripagiengineering.co.id/assets/template-2/css/style.css" />
    <link href="https://mentaripagiengineering.co.id/assets/css/main.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <style>
    :root {
        --col-particle: #fff;
        --col-particle-stroke: #fff;
        --col-particle-stroke-hover: #fff;
    }
    #particles {
        position: absolute;
        height: 600px;
        width: 100%;
        z-index: -1;
        left: 0;
    }
    #home::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5); /* Change color and opacity here */
        z-index: 1; /* Ensure it is above the background but below content */
    }

    #home .title {
        position: relative;
        color: white; /* Text color */
        z-index: 2; /* Ensure text is above the mask */
        text-align: center; /* Center text */
        padding: 20px; /* Add padding for better appearance */
    }

    .product-flow {
        /* display: flex; */
        align-items: center;
        font-size: 24px;
    }

    .hide {
        top: -130px;
    }

    .step {
        text-align: center;
    }

    .arrow {
        margin-left: 10px;
        margin-right: 10px;
        width: 50px;
        border-top: solid 3px #000;
    }

    .flow-icon {
        height: 120px;
    }
    </style>
</head>
<body onload="particles()">
    <div class="preloader" style="display: none">
        <div class="loader">
            <div class="spinner">
                <div class="spinner-container">
                    <div class="spinner-rotator">
                        <div class="spinner-left">
                            <div class="spinner-circle"></div>
                        </div>
                        <div class="spinner-right">
                            <div class="spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== PRELOADER PART ENDS ======-->

    <!--====== HEADER PART START ======-->
    <header class="header-area">
        
        <div class="navbar-area" id="navbar-scroll">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg justify-content-center pb-0">
                    <a class="navbar-brand" href="https://mentaripagiengineering.co.id">
                        <img src="https://mentaripagiengineering.co.id/assets/img/logo-mpe-new.png" alt="Logo" style="height: 110px" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggler-icon"> </span>
                        <span class="toggler-icon"> </span>
                        <span class="toggler-icon"> </span>
                    </button>
                </nav>
                <nav class="navbar navbar-expand-lg pb-40">
                    <div class="collapse navbar-collapse sub-menu-bar justify-content-center"
                        id="navbarSupportedContent">
                        <ul id="nav" class="navbar-nav navmenu">
                            <li class="nav-item">
                                <a class="" href="https://mentaripagiengineering.co.id#home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="" href="https://mentaripagiengineering.co.id#partners">Clients</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a
                                  data-mdb-dropdown-init
                                  class="nav-link dropdown-toggle"
                                  href="#"
                                  role="button"
                                  aria-expanded="false"
                                >
                                Facilities
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a title="Design Engineering" href="https://mentaripagiengineering.co.id/facilities#section_designengineering">DesignEngineering</a></li>
                                    <li><a title="Laser Cutting" href="https://mentaripagiengineering.co.id/facilities#section_lasercutting">Laser Cutting</a></li>
                                    <li><a title="Punching / Nibbling" href="https://mentaripagiengineering.co.id/facilities#section_punchingnibbling">Punching /Nibbling</a></li>
                                    <li><a title="Bending" href="https://mentaripagiengineering.co.id/facilities#section_bending">Bending</a></li>
                                    <li><a title="Welding" href="https://mentaripagiengineering.co.id/facilities#section_welding">Welding</a></li>
                                    <li><a title="Finishing / Polish" href="https://mentaripagiengineering.co.id/facilities#section_finishingpolish">Finishing /Polish</a></li>
                                    <li><a title="Painting" href="https://mentaripagiengineering.co.id/facilities#section_painting">Painting</a></li>
                                    <li><a title="Assembling" href="https://mentaripagiengineering.co.id/facilities#section_assembling">Assembling</a></li>
                                    <li><a title="Quality Control" href="https://mentaripagiengineering.co.id/facilities#section_qualitycontrol">Quality Control</a></li>
                                    <li><a title="Installation Onsite" href="https://mentaripagiengineering.co.id/facilities#section_installationonsite">InstallationOnsite</a></li>
                                </ul>
                              </li>
                              <li class="nav-item dropdown">
                                <a
                                  data-mdb-dropdown-init
                                  class="nav-link dropdown-toggle"
                                  href="#"
                                  role="button"
                                  aria-expanded="false"
                                >
                                Products
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a title="Bain Marie" href="https://mentaripagiengineering.co.id/products/bain-marie">Bain Marie</a></li>
                                    <li><a title="Bak Urai Tembakau" href="https://mentaripagiengineering.co.id/products/bak-urai-tembakau">Bak Urai Tembakau</a></li>
                                    <li><a title="Blade Custom" href="https://mentaripagiengineering.co.id/products/blade-custom">Blade Custom</a></li>
                                    <li><a title="Custom Machine" href="https://mentaripagiengineering.co.id/products/custom-machine">Custom Machine</a></li>
                                    <li><a title="Drinking Outlet" href="https://mentaripagiengineering.co.id/products/drinking-outlet">Drinking Outlet</a></li>
                                    <li><a title="Ducting" href="https://mentaripagiengineering.co.id/products/ducting">Ducting</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="page-scroll" href="https://mentaripagiengineering.co.id#about">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="page-scroll" href="https://mentaripagiengineering.co.id#contact">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <!-- navbar collapse -->

                    
                </nav>
                <!-- navbar -->
            </div>
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</div>

        
        <div id="home" class="header-hero bg_cover" style="background-image: url(https://mentaripagiengineering.co.id/assets/template-2/images/header/banner-bg.jpg)">
            <div class="container">
                <canvas id="particles"></canvas>
                <div class="row justify-content-center title">
                    <div class="col-lg-8">
                        <div class="header-hero-content text-center" style="padding-top: 300px; padding-bottom: 200px">
                            <h3 class="header-sub-title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.2s">
                                Wujudkan Proyek Anda Bersama Kami
                            </h3>
                            <h2 class="header-title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.5s">
                                dengan bahan berkualitas dan presisi
                            </h2>
                            <p class="text wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.8s">
                                Kosultasikan kebutuhan Anda bersama Kami. Kami juga sangat terbuka dengan setiap kritik dan saran yang Anda berikan Sumber Daya yang profesional
                            </p>
                            <a href="https://wa.link/v4kyf3" class="main-btn wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.1s" target="_blank">
                                Reserve Now
                            </a>
                        </div>
                        <!-- header hero content -->
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-hero-image text-center wow fadeIn" data-wow-duration="1.3s" data-wow-delay="1.4s">
                            
                        </div>
                        <!-- header hero image -->
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- header hero -->
    </header>

        <div class="brand-area pt-90" id="partners">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="
                    brand-logo
                    d-flex
                    align-items-center
                    justify-content-center justify-content-md-between
                ">
                    <div class="single-logo mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                        <img src="https://mentaripagiengineering.co.id/assets/img/clients/client-1.png" alt="brand" />
                    </div>
                    <!-- single logo -->
                    <div class="single-logo mt-30 wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.2s">
                        <img src="https://mentaripagiengineering.co.id/assets/img/clients/client-2.png" alt="brand" />
                    </div>
                    <!-- single logo -->
                    <div class="single-logo mt-30 wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.3s">
                        <img src="https://mentaripagiengineering.co.id/assets/img/clients/client-3.png" alt="brand" />
                    </div>
                    <!-- single logo -->
                    <div class="single-logo mt-30 wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.4s">
                        <img src="https://mentaripagiengineering.co.id/assets/img/clients/client-4.png" alt="brand" />
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="
                    brand-logo
                    d-flex
                    align-items-center
                    justify-content-center justify-content-md-between
                ">
                    <!-- single logo -->
                    <div class="single-logo mt-30 wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.5s">
                        <img src="https://mentaripagiengineering.co.id/assets/img/clients/client-5.png" alt="brand" />
                    </div>

                    <div class="single-logo mt-30 wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.5s">
                        <img src="https://mentaripagiengineering.co.id/assets/img/clients/client-6.png" alt="brand" />
                    </div>

                    <div class="single-logo mt-30 wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.5s">
                        <img src="https://mentaripagiengineering.co.id/assets/img/clients/client-7.png" alt="brand" />
                    </div>

                    <div class="single-logo mt-30 wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.5s">
                        <img src="https://mentaripagiengineering.co.id/assets/img/clients/client-8.png" alt="brand" />
                    </div>
                    <!-- single logo -->
                </div>
                <!-- brand logo -->
            </div>
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</div>
    <section id="projects" class="portfolio section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Projects</h2>
        <p>Berikut beberapa contoh hasil project yang sudah kami kerjakan</p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">All</li>
                                <li data-filter=".filter-bain-marie">Bain Marie</li>
                                <li data-filter=".filter-bak-urai-tembakau">Bak Urai Tembakau</li>
                                <li data-filter=".filter-blade-custom">Blade Custom</li>
                                <li data-filter=".filter-custom-machine">Custom Machine</li>
                                <li data-filter=".filter-drinking-outlet">Drinking Outlet</li>
                                <li data-filter=".filter-ducting">Ducting</li>
                            </ul><!-- End Portfolio Filters -->

            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-bain-marie">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/bain-marie/1.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Bain Marie 1</h4>
                                <p>Set peralatan Cooking untuk Restoran</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/bain-marie/1.png" title="Bain Marie 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-bain-marie">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/bain-marie/2.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Bain Marie 2</h4>
                                <p>Set peralatan Cooking untuk Restoran</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/bain-marie/2.png" title="Bain Marie 2" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-bain-marie">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/bain-marie/3.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Bain Marie 3</h4>
                                <p>Set peralatan Cooking untuk Restoran</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/bain-marie/3.png" title="Bain Marie 3" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-bain-marie">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/bain-marie/4.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Bain Marie 4</h4>
                                <p>Set peralatan Cooking untuk Restoran</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/bain-marie/4.png" title="Bain Marie 4" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                                                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-bak-urai-tembakau">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/bak-urai-tembakau/1.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Bak Urai Tembakau 1</h4>
                                <p>Peralatan untuk membantu penguraian tembakau</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/bak-urai-tembakau/1.png" title="Bak Urai Tembakau 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-bak-urai-tembakau">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/bak-urai-tembakau/2.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Bak Urai Tembakau 2</h4>
                                <p>Peralatan untuk membantu penguraian tembakau</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/bak-urai-tembakau/2.png" title="Bak Urai Tembakau 2" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-bak-urai-tembakau">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/bak-urai-tembakau/3.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Bak Urai Tembakau 3</h4>
                                <p>Peralatan untuk membantu penguraian tembakau</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/bak-urai-tembakau/3.png" title="Bak Urai Tembakau 3" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                                                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-blade-custom">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/blade-custom/1.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Blade Custom 1</h4>
                                <p>Custom Sparepart Pemotong</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/blade-custom/1.png" title="Blade Custom 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-blade-custom">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/blade-custom/2.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Blade Custom 2</h4>
                                <p>Custom Sparepart Pemotong</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/blade-custom/2.png" title="Blade Custom 2" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-blade-custom">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/blade-custom/3.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Blade Custom 3</h4>
                                <p>Custom Sparepart Pemotong</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/blade-custom/3.png" title="Blade Custom 3" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-blade-custom">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/blade-custom/4.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Blade Custom 4</h4>
                                <p>Custom Sparepart Pemotong</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/blade-custom/4.png" title="Blade Custom 4" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                                                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-custom-machine">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/custom-machine/feeding-air-dan-tepung.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>FEEDING AIR DAN TEPUNG</h4>
                                <p>FEEDING AIR DAN TEPUNG</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/custom-machine/feeding-air-dan-tepung.png" title="FEEDING AIR DAN TEPUNG" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-custom-machine">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/custom-machine/mesin-reject-cigarette.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>MESIN REJECT CIGARETTE</h4>
                                <p>MESIN REJECT CIGARETTE</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/custom-machine/mesin-reject-cigarette.png" title="MESIN REJECT CIGARETTE" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-custom-machine">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/custom-machine/mesin-rit-bandrol.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>MESIN RIT BANDROL</h4>
                                <p>MESIN RIT BANDROL</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/custom-machine/mesin-rit-bandrol.png" title="MESIN RIT BANDROL" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                                                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-drinking-outlet">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/drinking-outlet/1.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Drinking Outlet 1</h4>
                                <p>Custom Set Dringking Outlet</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/drinking-outlet/1.png" title="Drinking Outlet 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-drinking-outlet">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/drinking-outlet/2.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Drinking Outlet 2</h4>
                                <p>Custom Set Dringking Outlet</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/drinking-outlet/2.png" title="Drinking Outlet 2" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-drinking-outlet">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/drinking-outlet/3.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Drinking Outlet 3</h4>
                                <p>Custom Set Dringking Outlet</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/drinking-outlet/3.png" title="Drinking Outlet 3" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                                                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-ducting">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/ducting/ducting.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>DUCTING</h4>
                                <p>DUCTING</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/ducting/ducting.png" title="DUCTING" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-ducting">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/ducting/elbow-ducting.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>ELBOW DUCTING</h4>
                                <p>ELBOW DUCTING</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/ducting/elbow-ducting.png" title="ELBOW DUCTING" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-ducting">
                        <div class="portfolio-content h-100">
                            <img src="https://mentaripagiengineering.co.id/assets/img/projects/ducting/reducer-ducting.png" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>REDUCER DUCTING</h4>
                                <p>REDUCER DUCTING</p>
                                <a href="https://mentaripagiengineering.co.id/assets/img/projects/ducting/reducer-ducting.png" title="REDUCER DUCTING" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                
                            </div>
                        </div>
                    </div>
                                                </div><!-- End Portfolio Container -->
        </div>
    </div>
</section><!-- /Portfolio Section -->
    <section id="about">
    <div class="about-area pt-70" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-content mt-50 wow fadeInLeftBig" data-wow-duration="1s" data-wow-delay="0.5s">
                        <div class="section-title">
                            <div class="line"></div>
                            <h3 class="title">
                                Why Us ?
                            </h3>
                        </div>
                        <!-- section title -->
                        <p class="text">
                            CV. Mentari Pagi Engineering didirikan pada 4 September 1995 di Jalan Teuku Umar No. 1 Medaeng, Waru, Sidoarjo, Jawa Timur - Indonesia. <br>
                            Perusahaan ini bergerak di bidang <i><b>"Steel Custom Fabrication"</b></i> jasa pelayanan teknis antara lain : <br>
                        </p>
                        <ol>
                            <li>- Pembuatan spare part mesin</li>
                            <li>- Pembuatan dan instalasi Drinking Outlet</li>
                            <li>- Pekerjaan Stainless Steel</li>
                            <li>- Pembuatan Punch and Dies</li>
                            <li>- Pembuatan Mould Press</li>
                            <li>- Desain dan pembuatan mesin industri</li>
                            <li>- Pembuatan dan pemasangan Railing</li>
                            <li>- Pembuatan "Custom Bain Marie"</li>
                            <li>- Dan lain - lain</li>
                        </ol>
                    </div>
                    <!-- about content -->
                </div>
                <div class="col-lg-6">
                    <div class="about-image text-center mt-50 wow fadeInRightBig" data-wow-duration="1s"
                        data-wow-delay="0.5s">
                        <img src="https://mentaripagiengineering.co.id/assets/template-2/images/about/about1.svg" alt="about" />
                    </div>
                    <!-- about image -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
        <div class="about-shape-1">
            <img src="https://mentaripagiengineering.co.id/assets/template-2/images/about/about-shape-1.svg" alt="shape" />
        </div>
    </div>
</section>    

    <section id="facts" class="video-counter pt-70">
    <div class="container section-title" data-aos="fade-up">
        <h2>Proses Kerja</h2>
        <p>Berikut proses kerja kami dalam pengerjaan project</p>
    </div><!-- End Section Title -->
    <div class="container">
        <div class=" wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
            <div class="">
                <div class="">
                    <div class="row  justify-content-center order-lg-last product-flow">
                        <div class="step col-12 col-md-2">
                            <img src="https://mentaripagiengineering.co.id/assets/img/progress/reserve.gif" class="flow-icon">
                            <p>1. Perencanaan</p>
                            
                        </div>
                        <div class="step col-12 col-md-2">
                            <img src="https://mentaripagiengineering.co.id/assets/img/progress/design.gif" class="flow-icon">
                            <p>2. Desain</p>
                            
                        </div>
                        <div class="step col-12 col-md-2">
                            <img src="https://mentaripagiengineering.co.id/assets/img/progress/approval.gif" class="flow-icon">
                            <p>3. Approval</p>
                            
                        </div>
                        <div class="step col-12 col-md-2">
                            <img src="https://mentaripagiengineering.co.id/assets/img/progress/production.gif" class="flow-icon">
                            <p>4. Production</p>
                            
                        </div>
                        <div class="step col-12 col-md-2">
                            <img src="https://mentaripagiengineering.co.id/assets/img/progress/send.gif" class="flow-icon">
                            <p>5. Pengiriman</p>
                            
                        </div>
                        <div class="step col-12 col-md-2">
                            <img src="https://mentaripagiengineering.co.id/assets/img/progress/install.gif" class="flow-icon">
                            <p>6. Instalasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>
    <section class="mt-100" id="contact">
        <div class="container">
            <div class=" wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="row">
                    <div class="col-12">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.978092963592!2d112.71758887573641!3d-7.356351772381698!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e4a8d8e96b19%3A0x5b5f6c80dd977d9d!2sJl.%20Teuku%20Umar%20No.1%2C%20Bungur%2C%20Medaeng%2C%20Kec.%20Waru%2C%20Kabupaten%20Sidoarjo%2C%20Jawa%20Timur%2061256!5e0!3m2!1sid!2sid!4v1727155655583!5m2!1sid!2sid" width="100%" height="270px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <footer id="footer" class="footer-area pt-120">
    <div class="container">
        <div class="subscribe-area wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
            <div class="row">
                <div class="col-lg-6">
                    <div class="subscribe-content mt-45">
                        <h2 class="subscribe-title">
                            Contact <br> <span>and Reservation</span>
                        </h2>

                        <div class="row mt-20">
                            <div class="col-12">
                                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                                    <i class="bi bi-geo-alt flex-shrink-0"></i>
                                    <div>
                                        <h5>Address</h5>
                                        <p>Jalan Teuku Umar No.1 Medaeng, Waru, Sidoarjo, Jawa Timur, Indonesia</p>
                                    </div>
                                </div><!-- End Info Item -->
                                <div class="info-item d-flex mt-10" data-aos="fade-up" data-aos-delay="400">
                                    <i class="bi bi-telephone flex-shrink-0"></i>
                                    <div>
                                        <h5>Call Us</h5>
                                        <p>+62 31 8537334</p>
                                    </div>
                                </div>
                                <div class="info-item d-flex mt-10" data-aos="fade-up" data-aos-delay="500">
                                    <i class="bi bi-envelope flex-shrink-0"></i>
                                    <div>
                                        <h5>Email Us</h5>
                                        <p>ahmadimp@yahoo.co.id</p>
                                    </div>
                                </div>
                                <div class="info-item d-flex mt-10" data-aos="fade-up" data-aos-delay="500">
                                    <i class="bi bi-envelope flex-shrink-0"></i>
                                    <div>
                                        <a href="https://wa.link/v4kyf3" class="btn btn-success" target="_blank"><i class="lni lni-whatsapp mr-10"></i> Reserve NOW</a>
                                    </div>
                                </div><!-- End Info Item -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-50">
                        <div class="card feedback-message" style="display: none">
                            <div class="card-body">
                                <div class="container text-center" style="padding-top: 50px; padding-bottom: 50px">
                                    <h4>Thank you for contacting us</h4>
                                    <p>Your message has been successfully sent. We will review and respond as soon as possible. If you have any further questions or need immediate assistance, please feel free to contact us via our WhatsApp. <br><br> We appreciate your time and attention. Thanks!</p>
                                </div>
                            </div>
                        </div>
                        <form action="#" id="form-message">
                            <div class="form-group my-3">
                                <input type="text" name="name" class="form-control" placeholder="Name" />
                            </div>
                            <div class="form-group my-3">
                                <input type="email" name="email" class="form-control" placeholder="E-mail" />
                            </div>
                            <div class="form-group my-3">
                                <input type="number" name="phone" class="form-control" placeholder="Phone Number" />
                            </div>
                            <div class="form-group my-3">
                                <textarea name="message" class="form-control" rows="10" placeholder="Message"></textarea>
                            </div>
                            <div class="form-group my-3">
                                <button type="button" class="btn btn-primary btn-lg btn-message">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- subscribe area -->
        <div class="footer-widget pb-100">
            
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="footer-about mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                        <a class="logo" href="javascript:void(0)">
                            <img src="https://mentaripagiengineering.co.id/assets/img/logo-mpe-new.png" alt="logo" />
                        </a>
                        <h4 class="mb-0 mt-20 text-white">Mentari Pagi Engineering</h4>
                        <p class="text mt-0">
                            Bersama kami, wujudkan project Anda untuk kemajuan Usaha dan Bisnis Anda
                        </p>
                        <div class="mt-10">
                            <img src="https://mentaripagiengineering.co.id/assets/template-2/images/brands/wa-qr.png" alt="hero" style="height: 100px" />
                        </div>

                        
                    </div>
                    <!-- footer about -->
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <div class="footer-link d-flex mt-50 justify-content-sm-between">
                        <div class="link-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">
                            <div class="footer-title">
                                <h4 class="title">Quick Link</h4>
                            </div>
                            <ul class="link">
                                <li><a href="https://mentaripagiengineering.co.id#home">Home</a></li>
                                <li><a href="https://mentaripagiengineering.co.id#partners">Clients</a></li>
                                <li><a href="https://mentaripagiengineering.co.id#projects">Projects</a></li>
                                <li><a href="https://mentaripagiengineering.co.id#about">About</a></li>
                                <li><a href="https://mentaripagiengineering.co.id#contact">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- footer link -->
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12">
                    <div class="footer-contact mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
                        <div class="footer-title">
                            <h4 class="title">Contact Us</h4>
                        </div>
                        <ul class="contact">
                            <li></li>
                            <li>ahmadimp@yahoo.co.id</li>
                            <li>+62 31 8537334</li>
                            <li>
                                Jalan Teuku Umar No.1 Medaeng, Waru, Sidoarjo <br> Jawa Timur, Indonesia
                            </li>
                        </ul>
                    </div>
                    <!-- footer contact -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- footer widget -->
        <div class="footer-copyright">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright d-sm-flex justify-content-between">
                        <div class="copyright-content">
                            <p class="text">
                                Designed and Developed by
                                Adnyanatech
                            </p>
                        </div>
                        <!-- copyright content -->
                    </div>
                    <!-- copyright -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- footer copyright -->
    </div>
    <!-- container -->
</footer>
    <!--====== BACK TOP TOP PART START ======-->
    <a href="#" class="back-to-top"> <i class="lni lni-chevron-up"> </i> </a>
    <!--====== BACK TOP TOP PART ENDS ======-->

    <!--====== Javascript Files ======-->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://mentaripagiengineering.co.id/assets/template-2/js/bootstrap.bundle.min.js"></script>
<script src="https://mentaripagiengineering.co.id/assets/template-2/js/wow.min.js"></script>
<script src="https://mentaripagiengineering.co.id/assets/template-2/js/glightbox.min.js"></script>
<script src="https://mentaripagiengineering.co.id/assets/template-2/js/count-up.min.js"></script>
<script src="https://mentaripagiengineering.co.id/assets/template-2/js/particles.min.js"></script>
<script src="https://mentaripagiengineering.co.id/assets/template-2/js/main.js"></script>

<script src="https://mentaripagiengineering.co.id/assets/plugins/notify/notify.js"></script>
<script src="https://mentaripagiengineering.co.id/assets/plugins/particles/js/ab-particles.min.js"></script>
<script src="https://mentaripagiengineering.co.id/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="https://mentaripagiengineering.co.id/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

<script>
particles(opacity=50, numParticles=10, sizeMultiplier=5, width=1, connections=true, connectionDensity=15, noBounceH=false, noBounceV=false, speed=50, avoidMouse=true, hover=true)

window.addEventListener('scroll', () => {
  if (window.scrollY > 70) {
      return document.querySelector('.navbar-area').classList.add('hide')
  }
  return document.querySelector('.navbar-area').classList.remove('hide')

});

$(document).on('click', '.btn-message', function () {
    var name = $(`[name="name"]`).val();
    var email = $(`[name="email"]`).val();
    var phone = $(`[name="phone"]`).val();
    var message = $(`[name="message"]`).val();

    ajaxCall('GET', "https://mentaripagiengineering.co.id/message", {name: name, email: email, phone: phone, message: message})
        .done(function (resp) {
            $(`form#form-message`).hide();
            $(`.feedback-message`).fadeIn();
        });
})

document.querySelectorAll('.isotope-layout').forEach(function(isotopeItem) {
    let layout = isotopeItem.getAttribute('data-layout') ?? 'masonry';
    let filter = isotopeItem.getAttribute('data-default-filter') ?? '*';
    let sort = isotopeItem.getAttribute('data-sort') ?? 'original-order';

    let initIsotope;
    imagesLoaded(isotopeItem.querySelector('.isotope-container'), function() {
      initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
        itemSelector: '.isotope-item',
        layoutMode: layout,
        filter: filter,
        sortBy: sort
      });
    });

    isotopeItem.querySelectorAll('.isotope-filters li').forEach(function(filters) {
      filters.addEventListener('click', function() {
        isotopeItem.querySelector('.isotope-filters .filter-active').classList.remove('filter-active');
        this.classList.add('filter-active');
        initIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        if (typeof aosInit === 'function') {
          aosInit();
        }
      }, false);
    });

});

$(".dropdown-toggle").on({
    click: function () {
      if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $(this).siblings('.dropdown-menu').hide();
      } else {
        $(this).addClass('active');
        $(this).siblings('.dropdown-menu').show();
      }
    }
});

</script>    <script>
function ajaxCall(method, url, params, async = false) {
    return $.ajax({
        type: method,
        url: url,
        data: params,
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        async: async,
        timeout: 50000,
        headers: {
            "X-CSRF-Token": "Pt0Yg4EqWNBhJxG1jsaMndZZvpBd51jBebzjarR0"
        }
    }).fail(function (jqXHR, textStatus, errorThrown) { 
        if (jqXHR.responseJSON) {
            if (jqXHR.responseJSON.errors !== undefined) {
                $.each(jqXHR.responseJSON.errors, function (i, item) {
                    // alertFailed(item);
                })
            } else {
                // alertFailed(errorThrown);
            }
        }
    });
}

function formatRupiah(number) {
    number = parseFloat(number);
    number = number.toFixed(0) + '';
    x = number.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return `Rp ` + (x1 + x2);
}

function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

function validateFileSize(jqueryInput) {
    const fileSize = jqueryInput[0].files[0].size / 1024 / 1024; // in MiB
    
    jqueryInput.parent().find('.warn-filesize').remove();
    jqueryInput.parents('form').find('button[type="submit"]').prop('disabled', false);
    if (fileSize > 10) {
        warnHtml = `<span class="text-danger warn-filesize">Maksimal upload file 10 Mb`;
        jqueryInput.parent().append(warnHtml);
        jqueryInput.parents('form').find('button[type="submit"]').prop('disabled', true);

        return false;
    }
    return true;
}
</script></body>
</html>
