<?php
session_start();
include 'db/functions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$profile = get_user_profile($user_id); // Bu fonksiyon veritabanından kullanıcı bilgilerini çekmeli
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Edit Profile</title>

  <!-- CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/icons/feather.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

  <style>
    .cat-item a {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100px;
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
</head>

<body class="fixed-bottom-bar">

  <div class="container pt-3">
    <p class="alert alert-info mb-3">
      Hoş geldin, <strong><?php echo $_SESSION['user_email'] ?? 'misafir'; ?></strong>!
    </p>
  </div>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8 mb-3">
        <div class="card shadow-sm p-4">
          <h4 class="mb-4">My Account</h4>

          <form method="POST" action="update_profile.php">
  <div class="mb-3">
    <label for="first_name" class="form-label">First Name</label>
    <input type="text" name="first_name" id="first_name" class="form-control"
      value="<?php echo htmlspecialchars($profile['name'] ?? ''); ?>">
  </div>

  <div class="mb-3">
    <label for="last_name" class="form-label">Last Name</label>
    <input type="text" name="last_name" id="last_name" class="form-control"
      value="<?php echo htmlspecialchars($profile['surname'] ?? ''); ?>">
  </div>

  <div class="mb-3">
    <label for="phone" class="form-label">Mobile Number</label>
    <input type="text" name="phone" id="phone" class="form-control"
      value="<?php echo htmlspecialchars($profile['phone'] ?? ''); ?>">
  </div>

  <div class="mb-3">
    <label for="mail" class="form-label">Email</label>
    <input type="email" name="mail" id="mail" class="form-control"
      value="<?php echo htmlspecialchars($profile['mail'] ?? ''); ?>" readonly>
  </div>

  <div class="mb-3">
    <label for="birth_date" class="form-label">Date of Birth</label>
    <input type="date" name="birth_date" id="birth_date" class="form-control"
      value="<?php echo htmlspecialchars($profile['birth_date'] ?? ''); ?>">
  </div>

  <button type="submit" class="btn btn-danger w-100">Save Changes</button>
</form>


          <div class="additional mt-4">
            <div class="change_password my-3">
              <a href="forgot_password.php"
                class="p-3 border rounded bg-white btn d-flex align-items-center">Change Password
                <i class="feather-arrow-right ms-auto"></i></a>
            </div>
            <div class="deactivate_account">
              <a href="forgot_password.php"
                class="p-3 border rounded bg-white btn d-flex align-items-center">Deactivate Account
                <i class="feather-arrow-right ms-auto"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
