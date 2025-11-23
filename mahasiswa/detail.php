<?php
require_once "../inc/config.php";
require_once "../class/Mahasiswa.php";

// cek login
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit;
}

// pastikan ada id
if (!isset($_GET["id"])) {
    die("ID mahasiswa tidak ditemukan.");
}

$id = intval($_GET["id"]);
$mahasiswa = new Mahasiswa($db);

if (!$mahasiswa->loadById($id)) {
    die("Data mahasiswa tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Detail Mahasiswa dengan NIM <?= htmlspecialchars($mahasiswa->nim) ?></h1>
    </header>
    <section>
        <h1>Detail Mahasiswa</h1>
        <a href="../index.php">Kembali</a>

        <div style="margin-top: 20px;">

            <p>NIM: <?= htmlspecialchars($mahasiswa->nim) ?></p>
            <p>Nama: <?= htmlspecialchars($mahasiswa->nama) ?></p>
            <p>Prodi: <?= htmlspecialchars($mahasiswa->prodi) ?></p>
            <p>Angkatan: <?= htmlspecialchars($mahasiswa->angkatan ) ?></p>
            <p>Status: <?= htmlspecialchars($mahasiswa->status) ?></p>

            <p>Foto:</p>
            <img src="../uploads/foto_mahasiswa/<?= htmlspecialchars($mahasiswa->foto) ?>" 
                style="width:220px; border:1px solid #ccc; border-radius:8px;">
        </div>

    </section>
  
</body>
</html>
