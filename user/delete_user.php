<?php
require_once "../inc/config.php";
require_once "../class/User.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit;
}

$user = new User($db);
$user->loadById($_SESSION["user_id"]);

if (isset($_POST["confirm"]) && $_POST["confirm"] === "yes") {

    $stmt = $db->prepare("DELETE FROM user WHERE id = ?");
    $stmt->execute([$user->id]);

    session_destroy();
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Akun</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h1>Konfirmasi Hapus Akun</h1>

<p>Kamu yakin mau menghapus akun ini?</p>

<p>Username: <?= htmlspecialchars($user->username) ?></p>
<p>Aksi ini ga bisa dibalikin.</p>

<form method="POST">
    <input type="hidden" name="confirm" value="yes">
    <button type="submit">Ya, hapus akun</button>
</form>

<br>
<a href="../index.php">Batal</a>

</body>
</html>
