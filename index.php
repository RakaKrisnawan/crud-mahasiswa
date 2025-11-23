<?php
require_once "inc/config.php";
require_once "class/Mahasiswa.php";
require_once "class/User.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user = new User($db);
$user->loadById($_SESSION["user_id"]);

$mahasiswa = new Mahasiswa($db);
$data_mahasiswa = $mahasiswa->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Home</h1>
  </header>

  <nav>
    <a href="logout.php">Logout</a>
  </nav>

  <main>
    <section>
      <h2>Welcome to the Dashboard</h2>
      <p>Halo <?= htmlspecialchars($user->name) ?>, selamat datang di dashboard kamu.</p>

      <p>Your data:</p>
      <ul>
        <li>Username: <?= htmlspecialchars($user->username) ?></li>
        <li>Name: <?= htmlspecialchars($user->name) ?></li>
        <li>Join Date: <?= htmlspecialchars($_SESSION["join_date"]) ?></li>
      </ul>
    </section>

    <a href="mahasiswa/create.php" class="btn-add">Tambah Data</a>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php if (!empty($data_mahasiswa)): ?>
        <?php $i = 1; foreach ($data_mahasiswa as $mhs): ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= htmlspecialchars($mhs["nim"]) ?></td>
                <td><?= htmlspecialchars($mhs["nama"]) ?></td>
                <td><?= htmlspecialchars($mhs["prodi"]) ?></td>
                <td><?= htmlspecialchars($mhs["status"]) ?></td>
                
                <td>
                    <a href="mahasiswa/detail.php?id=<?= $mhs['id'] ?>">Detail</a>
                    <a href="mahasiswa/update.php?id=<?= $mhs['id'] ?>">Edit</a>
                    <a href="mahasiswa/delete.php?id=<?= $mhs['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php $i++; endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">Belum ada data mahasiswa.</td>
            </tr>
        <?php endif; ?>
    </table>
  </main>
</body>
</html>
