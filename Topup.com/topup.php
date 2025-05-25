<?php
include 'function.php';
session_start();

// Pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$game_id = $_GET['id'];
$game = ambilData("SELECT * FROM games WHERE id = $game_id");
$packages = ambilData("SELECT paket.*, games.name AS nama_game FROM paket 
                       LEFT JOIN games ON paket.game_id = games.id
                       WHERE paket.game_id = $game_id");
?>

<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CincaStore - <?= $game[0]['name']; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'partials/navbar.php'; ?>

<div class="container mt-5">
  <h2 class="text-center text-warning mb-4"><?= $game[0]['name']; ?> - Pilih Paket</h2>

  <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach($packages as $p): ?>
      <div class="col">
        <div class="card h-100 shadow bg-dark border border-secondary text-white">
          <div class="card-body d-flex flex-column justify-content-between">
            <h5 class="card-title text-warning"><?= $p['nama_paket']; ?></h5>
            <p class="card-text mb-1">🧩 <strong><?= $p['jumlah_item']; ?></strong> <?= $p['nama_item']; ?></p>
            <p class="card-text">💰 <strong>Rp<?= number_format($p['harga'], 0, ',', '.'); ?></strong></p>
            <a href="topup_process.php?id=<?= $p['id'] ?>" class="btn btn-outline-warning mt-3">Checkout</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include 'partials/footer.php'; ?>
</body>
</html>
