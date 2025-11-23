<?php
require_once "../inc/config.php";
require_once "../class/Mahasiswa.php";

// Pastikan user login
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit;
}

// Buat object mahasiswa
$mahasiswaObj = new Mahasiswa($db);

// Jika submit form
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nim = trim($_POST["nim"] ?? "");
    $nama = trim($_POST["nama"] ?? "");
    $prodi = trim($_POST["prodi"] ?? "");
    $status = trim($_POST["status"] ?? "");

    // Validasi sederhana
    if ($nim === "" || $nama === "" || $prodi === "" || $status === "") {
        header("Location: create.php?error=empty");
        exit;
    }

    $foto_name = "";

if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === 0) {

    $allowed_ext = ["jpg", "jpeg", "png", "webp"];
    $allowed_mime = ["image/jpeg", "image/png", "image/webp"];

    $file_name = $_FILES["foto"]["name"];
    $file_size = $_FILES["foto"]["size"];
    $file_tmp  = $_FILES["foto"]["tmp_name"];

    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $mime = mime_content_type($file_tmp);

    // Validasi ekstensi
    if (!in_array($ext, $allowed_ext)) {
        header("Location: create.php?error=format");
        exit;
    }

    // Validasi MIME type
    if (!in_array($mime, $allowed_mime)) {
        header("Location: create.php?error=invalidmime");
        exit;
    }

    // Validasi size max 5MB
    if ($file_size > 5 * 1024 * 1024) {
        header("Location: create.php?error=bigfile");
        exit;
    }

    // Pastikan folder ada
    $upload_dir = "../uploads/foto_mahasiswa/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Buat nama file baru
    $foto_name = "foto_" . time() . "_" . rand(1000, 9999) . "." . $ext;

    move_uploaded_file($file_tmp, $upload_dir . $foto_name);
    }


    // Isi object
    $mahasiswaObj->nim = $nim;
    $mahasiswaObj->nama = $nama;
    $mahasiswaObj->prodi = $prodi;
    $mahasiswaObj->status = $status;
    $mahasiswaObj->foto = $foto_name;

    // Simpan
    if ($mahasiswaObj->create()) {
        header("Location: ../index.php?success=created");
        exit;
    }

    header("Location: create.php?error=failed");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
  <h1>Tambah Data Mahasiswa</h1>
</header>

<main>
  <section>

    <!-- sistem validasi -->
    <?php if (isset($_GET["error"]) && $_GET["error"] === "empty"): ?>
      <p>Semua field wajib diisi.</p>
    <?php endif; ?>

    <?php if (isset($_GET["error"]) && $_GET["error"] === "failed"): ?>
      <p>Gagal menyimpan data.</p>
    <?php endif; ?>
    
    <?php if (isset($_GET["error"]) && $_GET["error"] === "format"): ?>
        <p>Format file tidak didukung. Hanya JPG, PNG, WEBP.</p>
    <?php endif; ?>

    <?php if (isset($_GET["error"]) && $_GET["error"] === "invalidmime"): ?>
        <p>File bukan foto. Upload foto yang valid.</p>
    <?php endif; ?>

    <?php if (isset($_GET["error"]) && $_GET["error"] === "bigfile"): ?>
        <p>Ukuran foto maksimal 5MB.</p>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data" class="form-box">

      <div class="row">
        <label>NIM:</label>
        <input type="text" name="nim" required>
      </div>

      <div class="row">
        <label>Nama:</label>
        <input type="text" name="nama" required>
      </div>

      <div class="row">
        <label>Program Studi:</label>
        <select name="prodi" required>
          <option value="Sistem Informasi">Sistem Informasi</option>
          <option value="Teknologi Informasi">Teknologi Informasi</option>
          <option value="Sistem Komputer">Sistem Komputer</option>
        </select>
      </div>

      <div class="row">
        <label>Status:</label>
        <select name="status" required>
          <option value="aktif">Aktif</option>
          <option value="nonaktif">Nonaktif</option>
        </select>
      </div>

      <div class="row">
        <label>Foto:</label>
        <input type="file" name="foto">
      </div>

      <div class="row">
        <button type="submit">Simpan</button>
        <a href="/index.php" class="btn-back">Batal</a>
      </div>

    </form>
  </section>
</main>

</body>
</html>
