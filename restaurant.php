<?php
include 'db/functions.php';

if (!isset($_GET['restaurant_id']) || !is_numeric($_GET['restaurant_id'])) {
    header("Location: home.php");
    exit();
}
$restaurant_id = intval($_GET['restaurant_id']);

$restaurant = get_restaurant_details($restaurant_id);
if (!$restaurant) {
    echo "Restoran bulunamadı.";
    exit();
}

$average_rating = get_restaurant_average_rating($restaurant_id);
$menu_items = get_restaurant_menu($restaurant_id);
$comments = get_restaurant_comments($restaurant_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
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
    <div class="container my-4">
        <h2 class="fw-bold"><?php echo htmlspecialchars($restaurant['name']); ?></h2>
        <p class="text-muted">
            <?php echo htmlspecialchars($restaurant['county']); ?> -
            <?php echo htmlspecialchars($restaurant['category']); ?> -
            <?php echo htmlspecialchars($restaurant['price_range']); ?>
        </p>

        <div class="rating-wrap d-flex align-items-center mt-2">
            <ul class="rating-stars list-unstyled">
                <li>
                    <?php
                    $rounded = floor($average_rating);
                    for ($i = 0; $i < 5; $i++) {
                        echo $i < $rounded ? '<i class="feather-star text-warning"></i>' : '<i class="feather-star"></i>';
                    }
                    ?>
                </li>
            </ul>
            <p class="label-rating text-dark ms-2 small">(<?php echo $average_rating; ?> / 5)</p>
        </div>

        <h5 class="mt-4">Menü</h5>
        <?php while ($menu = $menu_items->fetch_assoc()): ?>
            <div class="d-flex gap-2 p-3 border-bottom">
                <img src="uploads/<?php echo htmlspecialchars($menu['image_url']); ?>" style="width:100px;" class="img-thumbnail me-3">
                <div>
                    <p class="mb-0">Menü Fotoğrafı</p>
                    <small class="text-muted"><?php echo htmlspecialchars($menu['created_at']); ?></small>
                </div>
            </div>
        <?php endwhile; ?>

        <h5 class="mt-4">Yorumlar</h5>
        <?php while ($comment = $comments->fetch_assoc()): ?>
            <div class="border p-3 mb-2 rounded">
                <strong><?php echo htmlspecialchars($comment['username']); ?></strong> - 
                <small class="text-muted"><?php echo date("d M Y", strtotime($comment['created_at'])); ?></small>
                <div class="mb-1">
                    <?php
                    $rating = intval($comment['rating']);
                    for ($i = 0; $i < 5; $i++) {
                        echo $i < $rating ? '<i class="feather-star text-warning"></i>' : '<i class="feather-star"></i>';
                    }
                    ?>
                </div>
                <p class="mb-0"><?php echo htmlspecialchars($comment['comment_text']); ?></p>
            </div>
        <?php endwhile; ?>
    </div>

    <script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="vendor/slick/slick/slick.min.js"></script>
    <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>
    <script type="text/javascript" src="js/osahan.js"></script>
</body>

</html>
