
<?php
session_start();
include 'db/functions.php';

$restaurant_id = $_GET['id'] ?? $_POST['restaurant_id'] ?? null;
if (!$restaurant_id || !is_numeric($restaurant_id)) {
    header("Location: home.php");
    exit();
}

// Yorum gönderme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'] ?? null;
    $rating = intval($_POST['rating'] ?? 0);
    $comment_text = trim($_POST['comment_text'] ?? '');

    if ($user_id && $rating >= 1 && $rating <= 5 && !empty($comment_text)) {
        rate_restaurant($user_id, $restaurant_id, $rating);
        add_comment($user_id, $restaurant_id, $comment_text);
        header("Location: restaurant.php?id=" . $restaurant_id . "&success=1");
exit();
    } else {
        $error = "Tüm alanları doğru şekilde doldurun.";
    }
}

$restaurant = get_restaurant_details($restaurant_id);
$average_rating = get_restaurant_average_rating($restaurant_id);
$menu_items = get_restaurant_menu_items($restaurant_id);
$menu_items_array = [];
while ($row = $menu_items->fetch_assoc()) {
    $menu_items_array[] = $row;
}

$comments = get_restaurant_comments($restaurant_id);
$features = get_restaurant_features($restaurant_id);
$gallery_images = get_restaurant_images($restaurant_id);
$grouped_menu = get_menu_grouped_by_section($restaurant_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Featsy - Online Food Platform">
    <meta name="author" content="Featsy">
    <link rel="icon" type="image/png" href="img/fav.png">
    <title><?php echo htmlspecialchars($restaurant['name']); ?> - Featsy</title>
    <link href="vendor/slick/slick/slick.css" rel="stylesheet" type="text/css">
    <link href="vendor/slick/slick/slick-theme.css" rel="stylesheet" type="text/css">
    <link href="vendor/icons/feather.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="vendor/sidebar/demo.css" rel="stylesheet">
</head>

<body class="fixed-bottom-bar">

<!-- Header -->
<header class="section-header">
    <section class="header-main shadow-sm bg-white">
        <div class="container">
            <div class="row align-items-center justify-content-between py-2">
                <div class="col-auto">
                    <a href="home.php" class="brand-wrap mb-0">
                        <img alt="logo" src="img/logo.png" class="img-fluid" style="height: 60px;">
                    </a>
                </div>
                <div class="col-auto d-flex align-items-center">
                    <a href="search.php" class="me-4 text-dark">
                        <div class="d-flex align-items-center">
                            <i class="feather-search h5 mb-0"></i>
                            <span class="ms-1">Search</span>
                        </div>
                    </a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle text-dark d-flex align-items-center" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img alt="#" src="img/homelogo/guestlogo.png" class="img-fluid rounded-circle me-2" style="height: 32px;">
                            <?php echo $_SESSION['user_email'] ?? 'Guest'; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="profile.php">My account</a>
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

<!-- Restaurant Top Banner -->
<section class="bg-dark text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-2"><?php echo htmlspecialchars($restaurant['name']); ?></h2>
                <p class="mb-1 text-white">
  <?php echo htmlspecialchars($restaurant['county']); ?> - 
  <?php echo htmlspecialchars($restaurant['category']); ?> - 
  <?php echo htmlspecialchars($restaurant['price_range']); ?>
</p>

                <div class="d-flex align-items-center my-2">
                    <ul class="rating-stars list-unstyled d-flex mb-0">
                        <li>
                            <?php
                            $rounded = floor($average_rating);
                            for ($i = 0; $i < 5; $i++) {
                                echo $i < $rounded ? '<i class="feather-star text-warning me-1"></i>' : '<i class="feather-star text-secondary me-1"></i>';
                            }
                            ?>
                        </li>
                    </ul>
                    <small class="ms-2">(<?php echo $average_rating; ?> / 5)</small>
                </div>
                <?php if (!empty($features)): ?>
    <p class="mb-2">
    <strong class="text-white">Özellikler:</strong>
        <?php foreach ($features as $feature): ?>
            <span class="badge bg-secondary me-1"><?php echo htmlspecialchars($feature['name']); ?></span>
        <?php endforeach; ?>
    </p>
<?php endif; ?>
<div class="d-flex mt-2">
    <div>
        <small class="text-white d-block fw-semibold">Çalışma Saatleri</small>
        <span class="fw-bold text-white">
            <?php echo htmlspecialchars($restaurant['opening_hours'] ?? 'Saat bilgisi yok'); ?>
        </span>
    </div>
</div>
            </div>
            <div class="col-md-4 text-md-end mt-4 mt-md-0">
                <img src="uploads/<?php echo htmlspecialchars($menu_items_array[0]['image_url'] ?? 'default.jpg'); ?>" class="img-fluid rounded shadow-sm" style="max-width: 200px; height: auto;">

            </div>
        </div>
    </div>
</section>

<!-- Main Content -->

<h5 class="mt-5 mb-4">Menü</h5>

<?php foreach ($grouped_menu as $section => $items): ?>
    <div class="row m-0">
        <h6 class="p-3 m-0 bg-light w-100">
            <?php echo htmlspecialchars($section); ?>
            <small class="text-black-50"><?php echo count($items); ?> ITEMS</small>
        </h6>
        <div class="col-md-12 px-0 border-top">
            <div class="bg-white">
                <?php foreach ($items as $item): ?>
                    <div class="d-flex align-items-center gap-2 p-3 border-bottom gold-members">
                        <?php if (!empty($item['image_url'])): ?>
                            <img alt="#" src="img/restaurants/<?php echo htmlspecialchars($item['image_url']); ?>" class="rounded-pill" style="width: 48px; height: 48px; object-fit: cover;">
                        <?php else: ?>
                            <div class="fw-bold text-success veg">.</div>
                        <?php endif; ?>

                        <div>
                            <h6 class="mb-1"><?php echo htmlspecialchars($item['name']); ?></h6>
                            <p class="text-muted mb-0"><?php echo number_format($item['price'], 2); ?> ₺</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php if ($gallery_images && $gallery_images->num_rows > 0): ?>
  <div class="mb-4">
    <h5 class="mb-3">Galeri</h5>
    <div class="slick-slider">
      <?php while ($img = $gallery_images->fetch_assoc()): ?>
        <div>
          <img src="img/restaurants/<?php echo htmlspecialchars($img['image_url']); ?>" class="img-fluid rounded" style="height:300px; width:100%; object-fit:cover;">
        </div>
      <?php endwhile; ?>
    </div>
  </div>
<?php endif; ?>


<div class="container my-5">
  <h5 class="mt-5 mb-4">Menü</h5>

<?php foreach ($grouped_menu as $section => $items): ?>
    <div class="row m-0">
        <h6 class="p-3 m-0 bg-light w-100">
            <?php echo htmlspecialchars($section); ?>
            <small class="text-black-50"><?php echo count($items); ?> ITEMS</small>
        </h6>
        <div class="col-md-12 px-0 border-top">
            <div class="bg-white">
                <?php foreach ($items as $item): ?>
                    <div class="d-flex align-items-center gap-2 p-3 border-bottom gold-members">
                        <?php if (!empty($item['image_url'])): ?>
                            <img alt="#" src="img/restaurants/<?php echo htmlspecialchars($item['image_url']); ?>" class="rounded-pill" style="width: 48px; height: 48px; object-fit: cover;">
                        <?php else: ?>
                            <div class="fw-bold text-success veg">.</div>
                        <?php endif; ?>

                        <div>
                            <h6 class="mb-1">
                                <?php echo htmlspecialchars($item['name']); ?>
                                <!-- Buraya örnek etiket koyabilirsin -->
                                <!-- <span class="badge text-bg-success">BEST SELLER</span> -->
                            </h6>
                            <p class="text-muted mb-0"><?php echo number_format($item['price'], 2); ?> ₺</p>
                        </div>

                        <span class="ms-auto">
                            <a href="#" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#extras">ADD</a>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

    </div>



    <div class="container mt-5">
    <h5 class="mb-3">Yorum Yap</h5>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="alert alert-success">Yorumunuz başarıyla kaydedildi.</div>
<?php endif; ?>
    <form method="POST" action="">
        <input type="hidden" name="restaurant_id" value="<?= $restaurant_id ?>">
        <div class="mb-3">
            <label for="rating" class="form-label">Puan</label>
            <select class="form-select" id="rating" name="rating" required>
                <option value="">Puan seçin</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="comment_text" class="form-label">Yorumunuz</label>
            <textarea class="form-control" id="comment_text" name="comment_text" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Yorumu Gönder</button>
    </form>
</div>

<!-- ✨ Yorumları Listele -->
<div class="container mt-5">
    <h5 class="mb-3">Yorumlar</h5>
    <?php
    $comments = get_restaurant_comments($restaurant_id);
    if ($comments && $comments->num_rows > 0):
        while ($comment = $comments->fetch_assoc()):
    ?>
        <div class="border-bottom pb-3 mb-3">
            <strong><?php echo htmlspecialchars($comment['username']); ?></strong> -
            <span class="text-warning"><?php echo str_repeat("★", intval($comment['rating'])); ?></span>
            <p class="mb-1"><?php echo htmlspecialchars($comment['comment_text']); ?></p>
            <small class="text-muted"><?php echo date("d.m.Y", strtotime($comment['created_at'])); ?></small>
        </div>
    <?php endwhile; else: ?>
        <p class="text-muted">Henüz yorum yapılmamış.</p>
    <?php endif; ?>
</div>


<!-- Footer -->
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
          <li><a href="not-found.php" class="text-muted">Not found</a></li>
          <li><a href="maintence.php" class="text-muted">Maintenance</a></li>
          <li><a href="coming-soon.php" class="text-muted">Coming Soon</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 col-sm-6">
        <h6 class="fw-bold">Services</h6>
        <ul class="list-unstyled small">
          <li><a href="faq.php" class="text-muted">Delivery Support</a></li>
          <li><a href="contact-us.php" class="text-muted">Contact Us</a></li>
          <li><a href="terms.php" class="text-muted">Terms of use</a></li>
          <li><a href="privacy.php" class="text-muted">Privacy policy</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 col-sm-6">
        <h6 class="fw-bold">For Users</h6>
        <ul class="list-unstyled small">
          <li><a href="login.php" class="text-muted">User Login</a></li>
          <li><a href="signup.php" class="text-muted">User Register</a></li>
          <li><a href="forgot_password.php" class="text-muted">Forgot Password</a></li>
          <li><a href="profile.php" class="text-muted">Account Settings</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 col-sm-6">
        <h6 class="fw-bold">More Pages</h6>
        <ul class="list-unstyled small">
          <li><a href="trending.php" class="text-muted">Trending</a></li>
          <li><a href="home.php" class="text-muted">Most Popular</a></li>
          <li><a href="restaurant.php" class="text-muted">Restaurant Detail</a></li>
          <li><a href="favorites.php" class="text-muted">Favorites</a></li>
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

<script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="vendor/slick/slick/slick.min.js"></script>
<script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>
<script type="text/javascript" src="js/osahan.js"></script>

<script>
  $(document).ready(function(){
    $('.slick-slider').slick({
      dots: true,
      infinite: true,
      speed: 500,
      slidesToShow: 1,
      adaptiveHeight: true,
      autoplay: true,
      autoplaySpeed: 3000
    });
  });
</script>


</body>
</html>