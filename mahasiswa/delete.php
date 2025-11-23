<?php
require_once "../inc/config.php";
require_once "../class/Mahasiswa.php";

// Pastikan user login
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit;
}

// Ambil ID dari URL
$id = $_GET["id"] ?? null;
if (!$id) {
    echo "ID tidak valid";
    exit;
}

$mahasiswaObj = new Mahasiswa($db);

// Load data mahasiswa
if (!$mahasiswaObj->loadById($id)) {
    echo "Data tidak ditemukan";
    exit;
}

// Kalau user konfirmasi hapus
if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["confirm"] ?? "") === "yes") {

    // Hapus foto jika ada
    if (!empty($mahasiswaObj->foto)) {
        $file_path = "../uploads/foto_mahasiswa/" . $mahasiswaObj->foto;
        if (file_exists($file_path) && is_file($file_path)) {
            unlink($file_path);
        }
    }

    // Hapus data dari database
    if ($mahasiswaObj->delete($id)) {
        header("Location: ../index.php?success=deleted");
        exit;
    }

    echo "Gagal menghapus data.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hapus Mahasiswa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
  <h1>Konfirmasi Penghapusan</h1>
</header>

<main>
  <section>

    <p>Apakah kamu yakin ingin menghapus data mahasiswa berikut?</p>

    <p>NIM: <?= htmlspecialchars($mahasiswaObj->nim) ?></p>
    <p>Nama: <?= htmlspecialchars($mahasiswaObj->nama) ?></p>

    <?php if (!empty($mahasiswaObj->foto)): ?>
        <img src="../uploads/foto_mahasiswa/<?= htmlspecialchars($mahasiswaObj->foto) ?>" width="90" alt="Foto Mahasiswa">
    <?php endif; ?>

    <form method="POST" style="margin-top:20px;">
        <input type="hidden" name="confirm" value="yes">
        <button type="submit">Ya, Hapus</button>
        <a href="../index.php" class="btn-back">Batal</a>
    </form>

  </section>
</main>

</body>
</html>
