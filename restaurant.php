<?php
session_start();
include 'db/functions.php';

if (!isset($_GET['restaurant_id']) || !is_numeric($_GET['restaurant_id'])) {
    header("Location: home.php");
    exit();
}

$restaurant_id = intval($_GET['restaurant_id']);

// ✳️ FORM GÖNDERİLDİYSE YORUMU İŞLE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'] ?? null;
    $rating = $_POST['rating'] ?? null;
    $comment_text = $_POST['comment_text'] ?? null;

    // Trim ve sayı kontrolü
    $comment_text = trim($comment_text);
    $rating = is_numeric($rating) ? intval($rating) : null;

    if ($user_id && $rating >= 1 && $rating <= 5 && !empty($comment_text)) {
        // Veritabanına kayıt
        rate_restaurant($user_id, $restaurant_id, $rating);
        add_comment($user_id, $restaurant_id, $comment_text);
        header("Location: restaurant.php?restaurant_id=" . $restaurant_id);
        exit();
    } else {
        $error = "Tüm alanlar doldurulmalıdır.";
    }
}

$restaurant = get_restaurant_details($restaurant_id);
$average_rating = get_restaurant_average_rating($restaurant_id);
$menu_items = get_restaurant_menu($restaurant_id);
$comments = get_restaurant_comments($restaurant_id);
$features = get_restaurant_features($restaurant_id);
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
                    <a href="home.html" class="brand-wrap mb-0">
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

<!-- Restaurant Top Banner -->
<section class="bg-dark text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-2"><?php echo htmlspecialchars($restaurant['name']); ?></h2>
                <p class="mb-1"><?php echo htmlspecialchars($restaurant['county']); ?> - <?php echo htmlspecialchars($restaurant['category']); ?> - <?php echo htmlspecialchars($restaurant['price_range']); ?></p>

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
        <strong>Özellikler:</strong>
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
                <img src="uploads/<?php echo htmlspecialchars($menu_items->fetch_assoc()['image_url'] ?? 'default.jpg'); ?>" class="img-fluid rounded shadow-sm" style="max-width: 200px; height: auto;">
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="container my-5">
    <h5 class="mt-4">Menü</h5>
    <?php while ($menu = $menu_items->fetch_assoc()): ?>
        <div class="d-flex gap-3 p-3 border rounded mb-3">
            <img src="uploads/<?php echo htmlspecialchars($menu['image_url']); ?>" style="width:100px; height:100px; object-fit:cover;" class="img-thumbnail">
            <div>
                <p class="mb-1 fw-semibold">Menü Fotoğrafı</p>
                <small class="text-muted"><?php echo htmlspecialchars($menu['created_at']); ?></small>
            </div>
        </div>
    <?php endwhile; ?>

    <div class="container mt-5">
    <h5 class="mb-3">Yorum Yap</h5>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"> <?php echo $error; ?> </div>
    <?php endif; ?>
    <form method="POST" action="">
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
<div class="container my-5">
    <h5 class="mt-5">Yorumlar</h5>
    <?php while ($comment = $comments->fetch_assoc()): ?>
        <div class="border p-3 mb-3 rounded">
            <strong><?php echo htmlspecialchars($comment['username']); ?></strong>
            <small class="text-muted"> - <?php echo date("d M Y", strtotime($comment['created_at'])); ?></small>
            <div class="mb-2">
                <?php
                $rating = intval($comment['rating'] ?? 0);
                for ($i = 0; $i < 5; $i++) {
                    echo $i < $rating ? '<i class="feather-star text-warning"></i>' : '<i class="feather-star"></i>';
                }
                ?>
            </div>
            <p class="mb-0"><?php echo htmlspecialchars($comment['comment_text']); ?></p>
        </div>
    <?php endwhile; ?>
</div>


<!-- Footer -->
<footer class="section-footer border-top bg-dark text-white py-4">
    <div class="container text-center">
        <p class="mb-0">&copy; 2023 Featsy. All rights reserved.</p>
    </div>
</footer>

<script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="vendor/slick/slick/slick.min.js"></script>
<script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>
<script type="text/javascript" src="js/osahan.js"></script>

</body>
</html>