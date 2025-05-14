<?php
session_start();
include 'db/functions.php';
$popular_restaurants = get_popular_restaurants(8);
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
    <style>
.cat-item a {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100px; /* kutular eşit yükseklikte olsun */
  height: 100%;
  text-align: center;
}

.cat-item img {
  height: 40px;
  width: 40px;
  object-fit: contain;
  margin-bottom: 5px;
}

.cat-item p {
  margin: 0;
  font-size: 14px;
  line-height: 1.2;
}
</style>

    <!-- Hoş geldin mesajı -->
    <div class="container pt-3">
        <p class="alert alert-info mb-3">
            Hoş geldin, <strong><?php echo $_SESSION['user_email'] ?? 'misafir'; ?></strong>!
        </p>
    </div>

    <header class="section-header">
        <section class="header-main shadow-sm bg-white">
  <div class="container">
    <div class="row align-items-center justify-content-between py-2">
      <!-- ✅ Sol: Logo -->
      <div class="col-auto">
  <a href="home.php" class="brand-wrap mb-0">
    <img alt="logo" src="img/logo.png" class="img-fluid" style="height: 80px;">
  </a>
</div>

      <!-- ✅ Sağ: Search ve Guest -->
      <div class="col-auto d-flex align-items-center gap-4">

        <!-- Search -->
        <a href="search.php" class="d-flex align-items-center text-dark text-decoration-none">
          <i class="feather-search h5 mb-0 me-1"></i>
          <span class="fw-semibold">Search</span>
        </a>

        <!-- Guest dropdown -->
        <div class="dropdown">
          <a href="#" class="dropdown-toggle d-flex align-items-center text-dark text-decoration-none"
             id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="img/homelogo/guestlogo.png" alt="User" class="rounded-circle me-2"
                 style="width: 32px; height: 32px;">
            <span class="fw-semibold"><?php echo $_SESSION['user_email'] ?? 'Guest'; ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="profile.html">My account</a>
            <a class="dropdown-item" href="faq.html">Delivery support</a>
            <a class="dropdown-item" href="contact-us.html">Contact us</a>
            <a class="dropdown-item" href="terms.html">Terms of use</a>
            <a class="dropdown-item" href="privacy.html">Privacy policy</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
    </header>

    <!-- Devamında gelen sayfa içeriğini aynen bırakabilirsin -->


        <!-- Filters -->
         
        <div class="container">
            <div class="cat-slider">
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/homelogo/americanlogo.png" class="img-fluid mb-2">
                        <p class="m-0 small">Amerikan Mutfağı</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/homelogo/italyanlogo.png" class="img-fluid mb-2">
                        <p class="m-0 small">İtalyan Mutfağı</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/homelogo/fastfoodlogo.png" class="img-fluid mb-2">
                        <p class="m-0 small">Fast Food</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/homelogo/uzakdogulogo.png" class="img-fluid mb-2">
                        <p class="m-0 small">Uzak Doğu</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/homelogo/tatlılogo.png" class="img-fluid mb-2">
                        <p class="m-0 small">Tatlı</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/homelogo/kokteyllogo.png" class="img-fluid mb-2">
                        <p class="m-0 small">Kokteyl</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/homelogo/meksikalogo.png" class="img-fluid mb-2">
                        <p class="m-0 small">Meksika Mutfağı</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/homelogo/sokaklezzetleri.png" class="img-fluid mb-2">
                        <p class="m-0 small">Sokak Lezzetleri</p>
                    </a>
                </div>
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                        <img alt="#" src="img/homelogo/romanticdinnerlogo.png" class="img-fluid mb-2">
                        <p class="m-0 small">Romantik Akşam Yemeği</p>
                    </a>
                </div>
            </div>
        </div>
       
        <div class="container">

            <!-- Most popular -->
              <!-- Most popular -->
           <div class="py-3 title d-flex align-items-center">
                <h5 class="m-0">Most popular</h5>
                <a class="fw-bold ms-auto" href="most_popular.html">26 places <i class="feather-chevrons-right"></i></a>
            </div>
   <div class="row g-3">
  <?php
  $imageCount = 1;
  foreach ($popular_restaurants as $restaurant):
      // Fotoğraf isimleri img/restaurants/1.jpg, 2.jpg, ... şeklinde olacak
      $imagePath = "img/restaurants/" . $imageCount . ".jpg";
  ?>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
        <div class="list-card-image">
          <div class="star position-absolute">
            <span class="badge text-bg-success">
              <i class="feather-star"></i>
              <?= $restaurant['average_rating'] ?? '0.0' ?>
              (<?= $restaurant['total_ratings'] ?>)
            </span>
          </div>
          <div class="favourite-heart text-danger position-absolute rounded-circle">
            <a href="#"><i class="feather-heart"></i></a>
          </div>
          <a href="restaurant.php?id=<?= $restaurant['id'] ?>">
            <img alt="Restaurant Image" src="<?= $imagePath ?>" class="img-fluid item-img w-100" style="height: 200px; object-fit: cover;">
          </a>
        </div>
        <div class="p-3 position-relative">
          <div class="list-card-body">
            <h6 class="mb-1">
              <a href="restaurant.php?id=<?= $restaurant['id'] ?>" class="text-black">
                <?= htmlspecialchars($restaurant['name']) ?>
              </a>
            </h6>
            <p class="text-gray mb-1 small">• <?= $restaurant['category_name'] ?? 'Unknown' ?></p>
            <ul class="rating-stars list-unstyled">
              <li>
                <?php
                $rating = round($restaurant['average_rating']);
                for ($i = 1; $i <= 5; $i++) {
                  echo '<i class="feather-star' . ($i <= $rating ? ' star_active' : '') . '"></i>';
                }
                ?>
              </li>
            </ul>
          </div>
          <div class="list-card-badge">
            <span class="badge text-bg-danger">POPULAR</span>
          </div>
        </div>
      </div>
    </div>
  <?php
    $imageCount++;
  endforeach;
  ?>
</div>


<footer class="section-footer border-top bg-dark text-white">
  <div class="container py-5">
    <div class="row gy-4">
      <!-- About Us -->
      <div class="col-lg-4 col-md-6">
        <div class="d-flex">
          <img src="img/logo.png" alt="Featsy Logo" style="height: 60px;" class="me-3">
          <div>
            <h6 class="fw-bold text-white">About Us</h6>
            <p class="text-muted mb-2 small">Featsy, yerel lezzetleri keşfetmenizi kolaylaştıran modern bir restoran rehberidir. Benzersiz deneyimler için doğru adres.</p>
            <div class="d-flex gap-2">
              <a class="btn btn-sm btn-outline-light" href="#"><i class="feather-facebook"></i></a>
              <a class="btn btn-sm btn-outline-light" href="#"><i class="feather-instagram"></i></a>
              <a class="btn btn-sm btn-outline-light" href="#"><i class="feather-twitter"></i></a>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer Columns -->
      <div class="col-lg-2 col-md-3 col-sm-6">
        <h6 class="fw-bold">Error Pages</h6>
        <ul class="list-unstyled small">
          <li><a href="not-found.html" class="text-muted">Not found</a></li>
          <li><a href="maintence.html" class="text-muted">Maintenance</a></li>
          <li><a href="coming-soon.html" class="text-muted">Coming Soon</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 col-sm-6">
        <h6 class="fw-bold">Services</h6>
        <ul class="list-unstyled small">
          <li><a href="faq.html" class="text-muted">Delivery Support</a></li>
          <li><a href="contact-us.html" class="text-muted">Contact Us</a></li>
          <li><a href="terms.html" class="text-muted">Terms of use</a></li>
          <li><a href="privacy.html" class="text-muted">Privacy policy</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 col-sm-6">
        <h6 class="fw-bold">For Users</h6>
        <ul class="list-unstyled small">
          <li><a href="login.html" class="text-muted">User Login</a></li>
          <li><a href="signup.html" class="text-muted">User Register</a></li>
          <li><a href="forgot_password.html" class="text-muted">Forgot Password</a></li>
          <li><a href="profile.html" class="text-muted">Account Settings</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 col-sm-6">
        <h6 class="fw-bold">More Pages</h6>
        <ul class="list-unstyled small">
          <li><a href="trending.html" class="text-muted">Trending</a></li>
          <li><a href="most_popular.html" class="text-muted">Most Popular</a></li>
          <li><a href="restaurant.html" class="text-muted">Restaurant Detail</a></li>
          <li><a href="favorites.html" class="text-muted">Favorites</a></li>
        </ul>
      </div>
    </div>

    <hr class="border-secondary mt-5">

    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-muted small">
      <p class="mb-2 mb-md-0">© 2025 Featsy. All rights reserved.</p>
      <div>
        <a href="#"><img src="img/appstore.png" height="40" class="me-2" alt="App Store"></a>
        <a href="#"><img src="img/playmarket.png" height="40" alt="Google Play"></a>
      </div>
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