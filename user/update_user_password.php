<?php
require_once "../inc/config.php";
require_once "../class/User.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit;
}

$user = new User($db);
$user->loadById($_SESSION["user_id"]);

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pass_lama = $_POST["password_lama"] ?? "";
    $pass_baru = $_POST["password_baru"] ?? "";
    $pass_konfirmasi = $_POST["password_konfirmasi"] ?? "";

    if ($pass_baru !== $pass_konfirmasi) {
        $message = "Password baru dan konfirmasi tidak sama.";
    } elseif (!password_verify($pass_lama, $user->password)) {
        $message = "Password lama salah.";
    } else {
        $password_baru_hash = password_hash($pass_baru, PASSWORD_DEFAULT);

        $stmt = $db->prepare("UPDATE user SET password = ? WHERE id = ?");
        $stmt->execute([$password_baru_hash, $user->id]);

        session_destroy();
        header("Location: ../login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Ganti Password</h1>

    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Password Lama:</label><br>
        <input type="password" name="password_lama" required><br><br>

        <label>Password Baru:</label><br>
        <input type="password" name="password_baru" required><br><br>

        <label>Konfirmasi Password Baru:</label><br>
        <input type="password" name="password_konfirmasi" required><br><br>

        <button type="submit">Update Password</button>
    </form>

    <br>
    <a href="../index.php">Kembali</a>
</body>
</html>
