<?php
include 'function.php';
session_start();

// Pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$paket_id = $_GET['id'];
// $package = ambilData("SELECT * FROM paket INNER JOIN games ON paket.game_id = games.id WHERE paket.id = $paket_id")[0];
$package = ambilData("SELECT paket.*, games.name, games.icon_game FROM paket JOIN games ON paket.game_id = games.id WHERE paket.id = $paket_id")[0];



?>

<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CincaStore - <?= $package['name']; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'partials/navbar.php'; ?>


<div class="container mt-5">

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="text-center mb-4">
      <img src="admin/<?= $package['icon_game']; ?>" alt="<?= $package['name']; ?>" style="max-height: 100px;" class="mb-2 rounded-3 shadow-sm">
      <h2 class="text-light"><?= $package['name']; ?></h2>
    </div>

    <div class="card bg-dark text-light border-0 shadow-lg rounded-4">
      <div class="card-body">
        <h3 class="card-title text-center mb-4">
          <i class="bi bi-cart4 me-2 text-warning"></i> Checkout Paket
        </h3>
        
        <div class="mb-4 text-center">
          <h5 class="fw-semibold"><?= $package['nama_paket']; ?></h5>
          <p class="mb-1"><?= $package['jumlah_item']; ?> <?= $package['nama_item']; ?></p>
          <h4 class="text-warning fw-bold">Rp <?= number_format($package['harga'], 0, ',', '.'); ?></h4>
        </div>

        <form action="proses_checkout.php" method="POST">
          <input type="hidden" name="paket_id" value="<?= $package['id']; ?>">

          <div class="mb-3">
            <label for="player_id" class="form-label">Player ID</label>
            <input type="text" class="form-control bg-dark text-light" id="player_id" name="player_id" placeholder="Masukkan Player ID" required>
          </div>

          <div class="mb-3">
            <label for="server_id" class="form-label">Server ID</label>
            <input type="text" class="form-control bg-dark text-light" id="server_id" name="server_id" placeholder="Masukkan Server ID" required>
          </div>

          <div class="mb-4">
            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
            <select class="form-select bg-dark text-light" id="metode_pembayaran" name="metode_pembayaran" required>
              <option selected disabled>Pilih metode</option>
              <option value="Dana - 081997559327">Dana</option>
              <option value="OVO - 081997559327">OVO</option>
              <option value="Gopay - 081997559327">Gopay</option>
              <option value="Bank BCA - 721234567">Bank Transfer</option>
            </select>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-warning fw-bold">
              <i class="bi bi-credit-card-2-back me-1"></i> Lanjutkan Pembayaran
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


  
</div>

<?php include 'partials/footer.php'; ?>
</body>
</html>
