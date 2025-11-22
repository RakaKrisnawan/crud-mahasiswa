<?php

// require necessary files
require_once "inc/config.php";

// check if user is logged in
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// get prefill data
$prefill_username = $_GET["username"] ?? "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Login User</h1>
  </header>

  <main>
    <section>
      <?php if (isset($_GET["error"])): ?>
        <p>Login gagal, cek username atau password.</p>
      <?php endif; ?>

      <?php if (isset($_GET["success"]) && $_GET["success"] === "registered"): ?>
        <p>Registrasi berhasil, silakan login.</p>
      <?php endif; ?>

      <form action="authenticate.php" method="POST" id="form-login">
        <div class="row">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" value="<?= htmlspecialchars($prefill_username) ?>" autofocus required>
        </div>

        <div class="row">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>

        <div class="row">
          <button type="submit" name="login">Login</button>
        </div>
      </form>

      <p>Belum punya akun? <a href="register.php">Register</a></p>
    </section>
  </main>
</body>
</html>
