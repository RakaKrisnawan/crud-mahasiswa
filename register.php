<?php
require_once "inc/config.php";

// kalau sudah login, lempar balik
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Register User</h1>
  </header>

  <main>
    <section>
      <?php if (isset($_GET["error"])): ?>
        <p>Gagal daftar, pastikan semua data valid.</p>
      <?php endif; ?>

      <?php if (isset($_GET["error_password"])): ?>
        <p>Password dan konfirmasi tidak sama.</p>
      <?php endif; ?>

      <form action="authenticate.php" method="POST" id="form-register">
        <div class="row">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>
        </div>

        <div class="row">
          <label for="name">Nama:</label>
          <input type="text" id="name" name="name" required>
        </div>

        <div class="row">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>

        <div class="row">
          <label for="confirm_password">Konfirmasi Password:</label>
          <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <div class="row">
          <button type="submit" name="register">Register</button>
        </div>
      </form>

      <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </section>
  </main>
</body>
</html>
