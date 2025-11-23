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

// Load data mahasiswa berdasarkan ID
if (!$mahasiswaObj->loadById($id)) {
    echo "Data tidak ditemukan";
    exit;
}

// Buat array agar lebih mudah dipakai di form
$data = [
    "id" => $mahasiswaObj->id,
    "nim" => $mahasiswaObj->nim,
    "nama" => $mahasiswaObj->nama,
    "prodi" => $mahasiswaObj->prodi,
    "status" => $mahasiswaObj->status,
    "foto" => $mahasiswaObj->foto
];

// Jika submit form
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nama = trim($_POST["nama"] ?? "");
    $prodi = trim($_POST["prodi"] ?? "");
    $status = trim($_POST["status"] ?? "");

    if ($nama === "" || $prodi === "" || $status === "") {
        header("Location: update.php?id=$id&error=empty");
        exit;
    }

    // Update data
    $mahasiswaObj->id = $id;
    $mahasiswaObj->nama = $nama;
    $mahasiswaObj->prodi = $prodi;
    $mahasiswaObj->status = $status;

    if ($mahasiswaObj->update()) {
        header("Location: ../index.php?success=updated");
        exit;
    }

    header("Location: update.php?id=$id&error=failed");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
  <h1>Edit Data Mahasiswa</h1>
</header>

<main>
  <section>

    <?php if (isset($_GET["error"]) && $_GET["error"] === "empty"): ?>
      <p>Semua field wajib diisi.</p>
    <?php endif; ?>

    <?php if (isset($_GET["error"]) && $_GET["error"] === "failed"): ?>
      <p>Gagal mengubah data.</p>
    <?php endif; ?>

    <form action="" method="POST" class="form-box">

      <div class="row">
        <label>NIM:</label>
        <input type="text" value="<?= htmlspecialchars($data['nim']) ?>" readonly>
      </div>

      <div class="row">
        <label>Nama:</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
      </div>

      <div class="row">
        <label>Program Studi:</label>
        <select name="prodi" required>
          <option value="Sistem Informasi" <?= $data['prodi']=="Sistem Informasi" ? "selected" : "" ?>>Sistem Informasi</option>
          <option value="Teknologi Informasi" <?= $data['prodi']=="Teknologi Informasi" ? "selected" : "" ?>>Teknologi Informasi</option>
          <option value="Sistem Komputer" <?= $data['prodi']=="Sistem Komputer" ? "selected" : "" ?>>Sistem Komputer</option>
        </select>
      </div>

      <div class="row">
        <label>Status:</label>
        <select name="status" required>
          <option value="aktif" <?= $data['status']=="aktif" ? "selected" : "" ?>>Aktif</option>
          <option value="nonaktif" <?= $data['status']=="nonaktif" ? "selected" : "" ?>>Nonaktif</option>
        </select>
      </div>

      <div class="row">
        <label>Foto:</label>
        <img src="../uploads/foto_mahasiswa/<?= $data['foto'] ?>" width="80">
        <p>(Foto tidak dapat diubah saat edit)</p>
      </div>

      <div class="row">
        <button type="submit">Simpan Perubahan</button>
        <a href="../index.php" class="btn-back">Batal</a>
      </div>

    </form>

  </section>
</main>

</body>
</html>
