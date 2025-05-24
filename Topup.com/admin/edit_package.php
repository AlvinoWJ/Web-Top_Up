<?php
session_start();
include '../function.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: package.php");
    exit;
}

$id = $_GET['id'];
$package = ambilData("SELECT * FROM paket WHERE id = $id")[0];
$games = ambilData("SELECT * FROM games");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $game_id = $_POST['jenis_game'];
    $nama_paket = htmlspecialchars($_POST['nama_paket']);
    $harga = intval($_POST['harga']);
    $jumlah_item = intval($_POST['jumlah_item']);
    $nama_item = htmlspecialchars($_POST['nama_item']);

    $query = "UPDATE paket SET 
              game_id = '$game_id',
              nama_paket = '$nama_paket',
              harga = '$harga',
              jumlah_item = '$jumlah_item',
              nama_item = '$nama_item'
              WHERE id = $id";

    if (mysqli_query($database, $query)) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href = 'package.php';</script>";
    } else {
        echo "<script>alert('Gagal update');</script>";
        echo mysqli_error($database);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Package</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2>Edit Package</h2>
  <form action="" method="POST">
    <div class="mb-3">
      <label class="form-label">Jenis Game</label>
      <select class="form-select" name="jenis_game" required>
        <?php foreach ($games as $game): ?>
          <option value="<?= $game['id'] ?>" <?= $package['game_id'] == $game['id'] ? 'selected' : '' ?>>
            <?= $game['name'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Nama Paket</label>
      <input type="text" class="form-control" name="nama_paket" value="<?= $package['nama_paket'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Harga</label>
      <input type="number" class="form-control" name="harga" value="<?= $package['harga'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Jumlah Item</label>
      <input type="number" class="form-control" name="jumlah_item" value="<?= $package['jumlah_item'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Nama Item</label>
      <input type="text" class="form-control" name="nama_item" value="<?= $package['nama_item'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="package.php" class="btn btn-secondary">Batal</a>
  </form>
</div>
</body>
</html>
