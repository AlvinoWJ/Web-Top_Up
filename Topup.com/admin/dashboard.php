<?php 
include '../function.php';
session_start();

if (!isset($_SESSION['username']) && $_SESSION['role_id'] != 1) {
    header("Location: /Web-top_up/topup.com/login.php");
    exit;
}


// Ambil statistik
$total_games = ambilData("SELECT COUNT(*) AS total FROM games")[0]['total'];
$total_paket = ambilData("SELECT COUNT(*) AS total FROM paket")[0]['total'];
$total_users = ambilData("SELECT COUNT(*) AS total FROM users")[0]['total'];
$total_transaksi = ambilData("SELECT COUNT(*) AS total FROM transaksi")[0]['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
  <?php include 'components/sidebar.php';?>

  <div class="container mt-4">
    <h2 class="mb-4">Dashboard Admin</h2>
    
    <div class="row g-4">
      <!-- Total Game -->
      <div class="col-md-3">
        <div class="card bg-primary text-white shadow-sm rounded-4">
          <div class="card-body d-flex align-items-center">
            <i class="bi bi-controller fs-1 me-3"></i>
            <div>
              <h5 class="card-title mb-1">Total Game</h5>
              <h3><?= $total_games ?></h3>
            </div>
          </div>
        </div>
      </div>

      <!-- Total Paket -->
      <div class="col-md-3">
        <div class="card bg-success text-white shadow-sm rounded-4">
          <div class="card-body d-flex align-items-center">
            <i class="bi bi-box-seam fs-1 me-3"></i>
            <div>
              <h5 class="card-title mb-1">Total Paket</h5>
              <h3><?= $total_paket ?></h3>
            </div>
          </div>
        </div>
      </div>

      <!-- Total User -->
      <div class="col-md-3">
        <div class="card bg-warning text-dark shadow-sm rounded-4">
          <div class="card-body d-flex align-items-center">
            <i class="bi bi-people fs-1 me-3"></i>
            <div>
              <h5 class="card-title mb-1">Total User</h5>
              <h3><?= $total_users ?></h3>
            </div>
          </div>
        </div>
      </div>

      <!-- Total Transaksi -->
      <div class="col-md-3">
        <div class="card bg-danger text-white shadow-sm rounded-4">
          <div class="card-body d-flex align-items-center">
            <i class="bi bi-cash-coin fs-1 me-3"></i>
            <div>
              <h5 class="card-title mb-1">Total Transaksi</h5>
              <h3><?= $total_transaksi ?></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
