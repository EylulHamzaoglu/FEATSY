<?php
session_start();
include 'db/functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <link rel="icon" type="image/png" href="img/fav.png">
    <title>Swiggiweb - Online Food Ordering Website Template</title>
    <!-- Slick Slider -->
    <link href="vendor/slick/slick/slick.css" rel="stylesheet" type="text/css">
    <link href="vendor/slick/slick/slick-theme.css" rel="stylesheet" type="text/css">
    <!-- Feather Icon-->
    <link href="vendor/icons/feather.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Sidebar CSS -->
    <link href="vendor/sidebar/demo.css" rel="stylesheet">
</head>

<body class="fixed-bottom-bar">

    <!-- Hoş geldin mesajı -->
    <div class="container pt-3">
        <p class="alert alert-info mb-3">
            Hoş geldin, <strong><?php echo $_SESSION['user_email'] ?? 'misafir'; ?></strong>!
        </p>
    </div>

    <header class="section-header">
        <section class="header-main shadow-sm bg-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-1">
                        <a href="home.html" class="brand-wrap mb-0">
                            <img alt="#" class="img-fluid" src="img/logo_web.png">
                        </a>
                    </div>
                    <div class="col-8">
                        <div class="d-flex align-items-center justify-content-end pe-5">

                            <!-- Sign in butonu yerine session'dan gelen kullanıcı -->
                            <div class="dropdown me-4 m-none">
                                <a href="#" class="dropdown-toggle text-dark py-3 d-block" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img alt="#" src="img/user/1.jpg"
                                        class="img-fluid rounded-circle header-user me-2 header-user">
                                    <?php echo $_SESSION['user_email'] ?? 'Guest'; ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="profile.html">My account</a>
                                    <a class="dropdown-item" href="faq.html">Delivery support</a>
                                    <a class="dropdown-item" href="contact-us.html">Contact us</a>
                                    <a class="dropdown-item" href="terms.html">Terms of use</a>
                                    <a class="dropdown-item" href="privacy.html">Privacy policy</a>
                                    <a class="dropdown-item" href="logout.php">Logout</a> <!-- NOT: login.html yerine logout.php -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>

    <!-- Devamında gelen sayfa içeriğini aynen bırakabilirsin -->

    <div class="osahan-home-page">
        <div class="bg-primary p-3 d-none">
            <div class="text-white">
                <div class="title d-flex align-items-center">
                    <a class="toggle" href="#">
                        <span></span>
                    </a>
                    <h4 class="fw-bold m-0 ps-5">Browse</h4>
                    <a class="text-white fw-bold ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        href="#">Filter</a>
                </div>
            </div>
            <div class="input-group bg-white rounded shadow-sm mt-3">
                <span class="input-group-text bg-transparent border-0 rounded-0"><i
                        class="feather-search"></i></span>
                <input type="text" class="form-control bg-transparent border-0 rounded-0 px-0 shadow-none"
                    placeholder="Enter Your Location" aria-label="Enter Your Location" >
            </div>
        </div>
        <!-- Filters -->
        <div class="container">
            <div class="cat-slider">
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/icons/Fries.png" class="img-fluid mb-2">
                        <p class="m-0 small">Fries</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/icons/Pizza.png" class="img-fluid mb-2">
                        <p class="m-0 small">Pizza</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/icons/Burger.png" class="img-fluid mb-2">
                        <p class="m-0 small">Burger</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/icons/Sandwich.png" class="img-fluid mb-2">
                        <p class="m-0 small">Sandwich</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/icons/Coffee.png" class="img-fluid mb-2">
                        <p class="m-0 small">Coffee</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/icons/Steak.png" class="img-fluid mb-2">
                        <p class="m-0 small">Steak</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/icons/ColaCan.png" class="img-fluid mb-2">
                        <p class="m-0 small">ColaCan</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/icons/Breakfast.png" class="img-fluid mb-2">
                        <p class="m-0 small">Breakfast</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/icons/Salad.png" class="img-fluid mb-2">
                        <p class="m-0 small">Salad</p>
                    </a>
                </div>
            </div>
        </div>
       
        <div class="container">

            <!-- Most popular -->
            <div class="py-3 title d-flex align-items-center">
                <h5 class="m-0">Most popular</h5>
                <a class="fw-bold ms-auto" href="most_popular.html">26 places <i class="feather-chevrons-right"></i></a>
            </div>
            <!-- Most popular -->
            <div class="most_popular">
                <div class="row">
                    <div class="col-md-3 pb-3">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge text-bg-success"><i
                                            class="feather-star"></i> 3.1 (300+)</span></div>
                                <div class="favourite-heart text-danger position-absolute rounded-circle"><a href="#"><i
                                            class="feather-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span
                                        class="badge text-bg-dark">Promoted</span></div>
                                <a href="restaurant.html">
                                    <img alt="#" src="img/popular1.png" class="img-fluid item-img w-100">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                                        </a>
                                    </h6>
                                    <p class="text-gray mb-1 small">• North • Hamburgers</p>
                                    <p class="text-gray mb-1 rating">
                                    </p>
                                    <ul class="rating-stars list-unstyled">
                                        <li>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star"></i>
                                        </li>
                                    </ul>
                                    <p></p>
                                </div>
                                <div class="list-card-badge">
                                    <span class="badge text-bg-danger">OFFER</span> <small>65% OSAHAN50</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 pb-3">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge text-bg-success"><i
                                            class="feather-star"></i> 3.1 (300+)</span></div>
                                <div class="favourite-heart text-danger position-absolute rounded-circle"><a href="#"><i
                                            class="feather-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span
                                        class="badge text-bg-dark">Promoted</span></div>
                                <a href="restaurant.html">
                                    <img alt="#" src="img/popular2.png" class="img-fluid item-img w-100">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1"><a href="restaurant.html" class="text-black">Thai Famous Indian
                                            Cuisine</a></h6>
                                    <p class="text-gray mb-1 small">• Indian • Pure veg</p>
                                    <p class="text-gray mb-1 rating">
                                    </p>
                                    <ul class="rating-stars list-unstyled">
                                        <li>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star"></i>
                                        </li>
                                    </ul>
                                    <p></p>
                                </div>
                                <div class="list-card-badge">
                                    <span class="badge text-bg-success">OFFER</span> <small>65% off</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 pb-3">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge text-bg-success"><i
                                            class="feather-star"></i> 3.1 (300+)</span></div>
                                <div class="favourite-heart text-danger position-absolute rounded-circle"><a href="#"><i
                                            class="feather-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span
                                        class="badge text-bg-dark">Promoted</span></div>
                                <a href="restaurant.html">
                                    <img alt="#" src="img/popular3.png" class="img-fluid item-img w-100">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                                        </a>
                                    </h6>
                                    <p class="text-gray mb-1 small">• Hamburgers • Pure veg</p>
                                    <p class="text-gray mb-1 rating">
                                    </p>
                                    <ul class="rating-stars list-unstyled">
                                        <li>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star"></i>
                                        </li>
                                    </ul>
                                    <p></p>
                                </div>
                                <div class="list-card-badge">
                                    <span class="badge text-bg-danger">OFFER</span> <small>65% OSAHAN50</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 pb-3">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge text-bg-success"><i
                                            class="feather-star"></i> 3.1 (300+)</span></div>
                                <div class="favourite-heart text-danger position-absolute rounded-circle"><a href="#"><i
                                            class="feather-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span
                                        class="badge text-bg-dark">Promoted</span></div>
                                <a href="restaurant.html">
                                    <img alt="#" src="img/popular4.png" class="img-fluid item-img w-100">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1"><a href="restaurant.html" class="text-black">Bite Me Now
                                            Sandwiches</a></h6>
                                    <p class="text-gray mb-1 small">American • Pure veg</p>
                                    <p class="text-gray mb-1 rating">
                                    </p>
                                    <ul class="rating-stars list-unstyled">
                                        <li>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star"></i>
                                        </li>
                                    </ul>
                                    <p></p>
                                </div>
                                <div class="list-card-badge">
                                    <span class="badge text-bg-success">OFFER</span> <small>65% off</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pb-3">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge text-bg-success"><i
                                            class="feather-star"></i> 3.1 (300+)</span></div>
                                <div class="favourite-heart text-danger position-absolute rounded-circle"><a href="#"><i
                                            class="feather-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span
                                        class="badge text-bg-dark">Promoted</span></div>
                                <a href="restaurant.html">
                                    <img alt="#" src="img/popular5.png" class="img-fluid item-img w-100">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                                        </a>
                                    </h6>
                                    <p class="text-gray mb-1 small">• North • Hamburgers</p>
                                    <p class="text-gray mb-1 rating">
                                    </p>
                                    <ul class="rating-stars list-unstyled">
                                        <li>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star"></i>
                                        </li>
                                    </ul>
                                    <p></p>
                                </div>
                                <div class="list-card-badge">
                                    <span class="badge text-bg-danger">OFFER</span> <small>65% OSAHAN50</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 pb-3">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge text-bg-success"><i
                                            class="feather-star"></i> 3.1 (300+)</span></div>
                                <div class="favourite-heart text-danger position-absolute rounded-circle"><a href="#"><i
                                            class="feather-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span
                                        class="badge text-bg-dark">Promoted</span></div>
                                <a href="restaurant.html">
                                    <img alt="#" src="img/popular6.png" class="img-fluid item-img w-100">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1"><a href="restaurant.html" class="text-black">Thai Famous Indian
                                            Cuisine</a></h6>
                                    <p class="text-gray mb-1 small">• Indian • Pure veg</p>
                                    <p class="text-gray mb-1 rating">
                                    </p>
                                    <ul class="rating-stars list-unstyled">
                                        <li>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star"></i>
                                        </li>
                                    </ul>
                                    <p></p>
                                </div>
                                <div class="list-card-badge">
                                    <span class="badge text-bg-success">OFFER</span> <small>65% off</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 pb-3">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge text-bg-success"><i
                                            class="feather-star"></i> 3.1 (300+)</span></div>
                                <div class="favourite-heart text-danger position-absolute rounded-circle"><a href="#"><i
                                            class="feather-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span
                                        class="badge text-bg-dark">Promoted</span></div>
                                <a href="restaurant.html">
                                    <img alt="#" src="img/popular7.png" class="img-fluid item-img w-100">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                                        </a>
                                    </h6>
                                    <p class="text-gray mb-1 small">• Hamburgers • Pure veg</p>
                                    <p class="text-gray mb-1 rating">
                                    </p>
                                    <ul class="rating-stars list-unstyled">
                                        <li>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star"></i>
                                        </li>
                                    </ul>
                                    <p></p>
                                </div>
                                <div class="list-card-badge">
                                    <span class="badge text-bg-danger">OFFER</span> <small>65% OSAHAN50</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 pb-3">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge text-bg-success"><i
                                            class="feather-star"></i> 3.1 (300+)</span></div>
                                <div class="favourite-heart text-danger position-absolute rounded-circle"><a href="#"><i
                                            class="feather-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span
                                        class="badge text-bg-dark">Promoted</span></div>
                                <a href="restaurant.html">
                                    <img alt="#" src="img/popular8.png" class="img-fluid item-img w-100">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1"><a href="restaurant.html" class="text-black">Bite Me Now
                                            Sandwiches</a></h6>
                                    <p class="text-gray mb-1 small">American • Pure veg</p>
                                    <p class="text-gray mb-1 rating">
                                    </p>
                                    <ul class="rating-stars list-unstyled">
                                        <li>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star star_active"></i>
                                            <i class="feather-star"></i>
                                        </li>
                                    </ul>
                                    <p></p>
                                </div>
                                <div class="list-card-badge">
                                    <span class="badge text-bg-success">OFFER</span> <small>65% off</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
    <!-- Footer -->
    <div class="osahan-menu-fotter fixed-bottom bg-white px-3 py-2 text-center d-none">
        <div class="row">
            <div class="col selected">
                <a href="home.html" class="text-danger small fw-bold text-decoration-none">
                    <p class="h4 m-0"><i class="feather-home text-danger"></i></p>
                    Home
                </a>
            </div>
            <div class="col">
                <a href="most_popular.html" class="text-dark small fw-bold text-decoration-none">
                    <p class="h4 m-0"><i class="feather-map-pin"></i></p>
                    Trending
                </a>
            </div>
            <div class="col bg-white rounded-circle mt-n4 px-3 py-2">
                <div class="bg-danger rounded-circle mt-n0 shadow">
                    <a href="checkout.html" class="text-white small fw-bold text-decoration-none">
                        <i class="feather-shopping-cart"></i>
                    </a>
                </div>
            </div>
            <div class="col">
                <a href="favorites.html" class="text-dark small fw-bold text-decoration-none">
                    <p class="h4 m-0"><i class="feather-heart"></i></p>
                    Favorites
                </a>
            </div>
            <div class="col">
                <a href="profile.html" class="text-dark small fw-bold text-decoration-none">
                    <p class="h4 m-0"><i class="feather-user"></i></p>
                    Profile
                </a>
            </div>
        </div>
    </div>
    <!-- footer -->
    <footer class="section-footer border-top bg-dark">
        <div class="container">
            <div class="footer-top padding-y py-5">
                <div class="row">
                    <aside class="col-md-4 footer-about">
                        <article class="d-flex pb-3">
                            <div><img alt="#" src="img/logo_web.png" class="logo-footer me-3"></div>
                            <div>
                                <h6 class="title text-white">About Us</h6>
                                <p class="text-muted">Some short text about company like You might remember the Dell
                                    computer commercials in which a youth reports.</p>
                                <div class="d-flex align-items-center">
                                    <a class="btn btn-icon btn-outline-light me-1 btn-sm" title="Facebook"
                                        target="_blank" href="#"><i class="feather-facebook"></i></a>
                                    <a class="btn btn-icon btn-outline-light me-1 btn-sm" title="Instagram"
                                        target="_blank" href="#"><i class="feather-instagram"></i></a>
                                    <a class="btn btn-icon btn-outline-light me-1 btn-sm" title="Youtube"
                                        target="_blank" href="#"><i class="feather-youtube"></i></a>
                                    <a class="btn btn-icon btn-outline-light me-1 btn-sm" title="Twitter"
                                        target="_blank" href="#"><i class="feather-twitter"></i></a>
                                </div>
                            </div>
                        </article>
                    </aside>
                    <aside class="col-sm-3 col-md-2 text-white">
                        <h6 class="title">Error Pages</h6>
                        <ul class="list-unstyled hov_footer">
                            <li> <a href="not-found.html" class="text-muted">Not found</a></li>
                            <li> <a href="maintence.html" class="text-muted">Maintence</a></li>
                            <li> <a href="coming-soon.html" class="text-muted">Coming Soon</a></li>
                        </ul>
                    </aside>
                    <aside class="col-sm-3 col-md-2 text-white">
                        <h6 class="title">Services</h6>
                        <ul class="list-unstyled hov_footer">
                            <li> <a href="faq.html" class="text-muted">Delivery Support</a></li>
                            <li> <a href="contact-us.html" class="text-muted">Contact Us</a></li>
                            <li> <a href="terms.html" class="text-muted">Terms of use</a></li>
                            <li> <a href="privacy.html" class="text-muted">Privacy policy</a></li>
                        </ul>
                    </aside>
                    <aside class="col-sm-3  col-md-2 text-white">
                        <h6 class="title">For users</h6>
                        <ul class="list-unstyled hov_footer">
                            <li> <a href="login.html" class="text-muted"> User Login </a></li>
                            <li> <a href="signup.html" class="text-muted"> User register </a></li>
                            <li> <a href="forgot_password.html" class="text-muted"> Forgot Password </a></li>
                            <li> <a href="profile.html" class="text-muted"> Account Setting </a></li>
                        </ul>
                    </aside>
                    <aside class="col-sm-3  col-md-2 text-white">
                        <h6 class="title">More Pages</h6>
                        <ul class="list-unstyled hov_footer">
                            <li> <a href="trending.html" class="text-muted"> Trending </a></li>
                            <li> <a href="most_popular.html" class="text-muted"> Most popular </a></li>
                            <li> <a href="restaurant.html" class="text-muted"> Restaurant Details </a></li>
                            <li> <a href="favorites.html" class="text-muted"> Favorites </a></li>
                        </ul>
                    </aside>
                </div>
                <!-- row.// -->
            </div>
            <!-- footer-top.// -->
            <section class="footer-center border-top padding-y py-5">
                <h6 class="title text-white">Countries</h6>
                <div class="row">
                    <aside class="col-sm-2 col-md-2 text-white">
                        <ul class="list-unstyled hov_footer">
                            <li> <a href="#" class="text-muted">India</a></li>
                            <li> <a href="#" class="text-muted">Indonesia</a></li>
                            <li> <a href="#" class="text-muted">Ireland</a></li>
                            <li> <a href="#" class="text-muted">Italy</a></li>
                            <li> <a href="#" class="text-muted">Lebanon</a></li>
                        </ul>
                    </aside>
                    <aside class="col-sm-2 col-md-2 text-white">
                        <ul class="list-unstyled hov_footer">
                            <li> <a href="#" class="text-muted">Malaysia</a></li>
                            <li> <a href="#" class="text-muted">New Zealand</a></li>
                            <li> <a href="#" class="text-muted">Philippines</a></li>
                            <li> <a href="#" class="text-muted">Poland</a></li>
                            <li> <a href="#" class="text-muted">Portugal</a></li>
                        </ul>
                    </aside>
                    <aside class="col-sm-2 col-md-2 text-white">
                        <ul class="list-unstyled hov_footer">
                            <li> <a href="#" class="text-muted">Australia</a></li>
                            <li> <a href="#" class="text-muted">Brasil</a></li>
                            <li> <a href="#" class="text-muted">Canada</a></li>
                            <li> <a href="#" class="text-muted">Chile</a></li>
                            <li> <a href="#" class="text-muted">Czech Republic</a></li>
                        </ul>
                    </aside>
                    <aside class="col-sm-2 col-md-2 text-white">
                        <ul class="list-unstyled hov_footer">
                            <li> <a href="#" class="text-muted">Turkey</a></li>
                            <li> <a href="#" class="text-muted">UAE</a></li>
                            <li> <a href="#" class="text-muted">United Kingdom</a></li>
                            <li> <a href="#" class="text-muted">United States</a></li>
                            <li> <a href="#" class="text-muted">Sri Lanka</a></li>
                        </ul>
                    </aside>
                    <aside class="col-sm-2 col-md-2 text-white">
                        <ul class="list-unstyled hov_footer">
                            <li> <a href="#" class="text-muted">Qatar</a></li>
                            <li> <a href="#" class="text-muted">Singapore</a></li>
                            <li> <a href="#" class="text-muted">Slovakia</a></li>
                            <li> <a href="#" class="text-muted">South Africa</a></li>
                            <li> <a href="#" class="text-muted">Green Land</a></li>
                        </ul>
                    </aside>
                    <aside class="col-sm-2 col-md-2 text-white">
                        <ul class="list-unstyled hov_footer">
                            <li> <a href="#" class="text-muted">Pakistan</a></li>
                            <li> <a href="#" class="text-muted">Bangladesh</a></li>
                            <li> <a href="#" class="text-muted">Bhutaan</a></li>
                            <li> <a href="#" class="text-muted">Nepal</a></li>
                        </ul>
                    </aside>
                </div>
                <!-- row.// -->
            </section>
        </div>
        <!-- //container -->
        <div class="footer-copyright border-top py-3 bg-light">
            <div class="container d-flex align-items-center">
                <p class="mb-0"> © 2023 Company All rights reserved </p>
                <p class="text-muted mb-0 ms-auto d-flex align-items-center">
                    <a href="#" class="d-block"><img alt="#" src="img/appstore.png" height="40"></a>
                    <a href="#" class="d-block ms-3"><img alt="#" src="img/playmarket.png" height="40"></a>
                </p>
            </div>
        </div>
    </footer>
    <nav id="main-nav">
        <ul class="second-nav">
            <li><a href="home.html"><i class="feather-home me-2"></i> Homepage</a></li>
            <li><a href="my_order.html"><i class="feather-list me-2"></i> My Orders</a></li>
            <li>
                <a href="#"><i class="feather-edit-2 me-2"></i> Authentication</a>
                <ul>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="signup.html">Register</a></li>
                    <li><a href="forgot_password.html">Forgot Password</a></li>
                    <li><a href="verification.html">Verification</a></li>
                    <li><a href="location.html">Location</a></li>
                </ul>
            </li>
            <li><a href="favorites.html"><i class="feather-heart me-2"></i> Favorites</a></li>
            <li><a href="trending.html"><i class="feather-trending-up me-2"></i> Trending</a></li>
            <li><a href="most_popular.html"><i class="feather-award me-2"></i> Most Popular</a></li>
            <li><a href="restaurant.html"><i class="feather-paperclip me-2"></i> Restaurant Detail</a></li>
            <li><a href="checkout.html"><i class="feather-list me-2"></i> Checkout</a></li>
            <li><a href="successful.html"><i class="feather-check-circle me-2"></i> Successful</a></li>
            <li><a href="map.html"><i class="feather-map-pin me-2"></i> Live Map</a></li>
            <li>
                <a href="#"><i class="feather-user me-2"></i> Profile</a>
                <ul>
                    <li><a href="profile.html">Profile</a></li>
                    <li><a href="favorites.html">Delivery support</a></li>
                    <li><a href="contact-us.html">Contact Us</a></li>
                    <li><a href="terms.html">Terms of use</a></li>
                    <li><a href="privacy.html">Privacy & Policy</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="feather-alert-triangle me-2"></i> Error</a>
                <ul>
                    <li><a href="not-found.html">Not Found</a>
                    <li><a href="maintence.html"> Maintence</a>
                    <li><a href="coming-soon.html">Coming Soon</a>
                </ul>
            </li>
            <li>
                <a href="#"><i class="feather-link me-2"></i> Navigation Link Example</a>
                <ul>
                    <li>
                        <a href="#">Link Example 1</a>
                        <ul>
                            <li>
                                <a href="#">Link Example 1.1</a>
                                <ul>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Link Example 1.2</a>
                                <ul>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">Link Example 2</a></li>
                    <li><a href="#">Link Example 3</a></li>
                    <li><a href="#">Link Example 4</a></li>
                    <li data-nav-custom-content>
                        <div class="custom-message">
                            You can add any custom content to your navigation items. This text is just an example.
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="bottom-nav">
            <li class="email">
                <a class="text-danger" href="home.html">
                    <p class="h5 m-0"><i class="feather-home text-danger"></i></p>
                    Home
                </a>
            </li>
            <li class="github">
                <a href="faq.html">
                    <p class="h5 m-0"><i class="feather-message-circle"></i></p>
                    FAQ
                </a>
            </li>
            <li class="ko-fi">
                <a href="contact-us.html">
                    <p class="h5 m-0"><i class="feather-phone"></i></p>
                    Help
                </a>
            </li>
        </ul>
    </nav>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="osahan-filter">
                        <div class="filter">
                            <!-- SORT BY -->
                            <div class="p-3 bg-light border-bottom">
                                <h6 class="m-0">SORT BY</h6>
                            </div>
                            <div class="border-bottom p-3">
                                <div class="form-check form-check-reverse m-0">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="customRadios1"
                                        value="option1" checked>
                                    <label class="form-check-label text-start w-100" for="customRadios1">
                                        Top Rated
                                    </label>
                                </div>
                            </div>
                            <div class="border-bottom p-3">
                                <div class="form-check form-check-reverse m-0">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="customRadios2"
                                        value="option2">
                                    <label class="form-check-label text-start w-100" for="customRadios2">
                                        Nearest Me
                                    </label>
                                </div>
                            </div>
                            <div class="border-bottom p-3">
                                <div class="form-check form-check-reverse m-0">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="customRadios3"
                                        value="option3">
                                    <label class="form-check-label text-start w-100" for="customRadios3">
                                        Cost High to Low
                                    </label>
                                </div>
                            </div>
                            <div class="border-bottom p-3">
                                <div class="form-check form-check-reverse m-0">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="customRadios4"
                                        value="option4">
                                    <label class="form-check-label text-start w-100" for="customRadios4">
                                        Cost Low to High
                                    </label>
                                </div>
                            </div>
                            <div class="border-bottom p-3">
                                <div class="form-check form-check-reverse m-0">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="customRadios5"
                                        value="option5">
                                    <label class="form-check-label text-start w-100" for="customRadios5">
                                        Most Popular
                                    </label>
                                </div>
                            </div>
                            <!-- Filter -->
                            <div class="p-3 bg-light border-bottom">
                                <h6 class="m-0">FILTER</h6>
                            </div>
                            <div class="border-bottom p-3">
                                <div class="form-check form-check-reverse m-0">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked>
                                    <label class="form-check-label text-start w-100" for="defaultCheck1">
                                        Open Now
                                    </label>
                                </div>
                            </div>
                            <div class="border-bottom p-3">
                                <div class="form-check form-check-reverse m-0">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                    <label class="form-check-label text-start w-100" for="defaultCheck2">
                                        Credit Cards
                                    </label>
                                </div>
                            </div>
                            <div class="border-bottom p-3">
                                <div class="form-check form-check-reverse m-0">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                                    <label class="form-check-label text-start w-100" for="defaultCheck3">
                                        Alcohol Served
                                    </label>
                                </div>
                            </div>
                            <!-- Filter -->
                            <div class="p-3 bg-light border-bottom">
                                <h6 class="m-0">ADDITIONAL FILTERS</h6>
                            </div>
                            <div class="px-3 pt-3">
                                <input type="range" class="form-range" min="0" max="5" step="0.5">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label>Min</label>
                                        <input class="form-control" placeholder="$0" type="number">
                                    </div>
                                    <div class="col-6 text-end">
                                        <label>Max</label>
                                        <input class="form-control" placeholder="$1,0000" type="number">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-0 border-0">
                    <div class="col-6 m-0 p-0">
                        <button type="button" class="btn border-top btn-lg w-100" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="col-6 m-0 p-0">
                        <button type="button" class="btn btn-primary btn-lg w-100">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- slick Slider JS-->
    <script type="text/javascript" src="vendor/slick/slick/slick.min.js"></script>
    <!-- Sidebar JS-->
    <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>
    <!-- Custom scripts for all pages-->
    <script type="text/javascript" src="js/osahan.js"></script>
</body>

</html>