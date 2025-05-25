<?php
session_start();
include '../function.php';

if (!isset($_SESSION['username']) && $_SESSION['role_id'] != 1) {
    header("Location: /Web-top_up/topup.com/login.php");
    exit;
}

// Ambil semua data transaksi
$data_transaksi = ambilData("SELECT 
    transaksi.*, 
    users.username, users.no_telpon,
    paket.nama_paket, paket.jumlah_item, paket.nama_item, paket.harga,
    games.name AS nama_game, games.icon_game
FROM transaksi
JOIN users ON transaksi.user_id = users.id
JOIN paket ON transaksi.paket_id = paket.id
JOIN games ON paket.game_id = games.id;");
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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>
  <?php include 'components/sidebar.php'; ?>

  <div class="container p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Transaksi</h2>
    </div>

    <table id="tabelTransaksi" class="table table-light table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Username</th>
          <th>No Telp</th>
          <th>Game</th>
          <th>Paket</th>
          <th>ID Player</th>
          <th>Bukti Bayar</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($data_transaksi)): ?>
          <?php foreach ($data_transaksi as $i => $trx): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= htmlspecialchars($trx['username']); ?></td>
              <td><?= $trx['no_telpon']; ?></td>
              <td>
                <img src="../admin/<?= $trx['icon_game']; ?>" alt="Gambar Game" style="max-width: 60px;" class="me-2">
                <?= htmlspecialchars($trx['nama_game']); ?>
              </td>
              <td><?= $trx['nama_paket']; ?> - <?= $trx['jumlah_item']; ?> <?= $trx['nama_item']; ?></td>
              <td><?= $trx['player_id']; ?> ( <?= $trx['server_id']; ?> )</td>
              <td>
                <?php if (!empty($trx['bukti_bayar'])): ?>
                  <a href="../<?= $trx['bukti_bayar']; ?>" target="_blank" class="btn btn-sm btn-success">Lihat Bukti</a>
                <?php else: ?>
                  <span class="text-muted">Belum diupload</span>
                <?php endif; ?>
              </td>
              <td class="text-nowrap">
  <?php if($trx['status'] != 'selesai') : ?>
    <a href="selesaikan_transaksi.php?id=<?= $trx['id']; ?>" 
       class="btn btn-sm btn-primary mb-1" 
       onclick="return confirm('Tandai transaksi ini sebagai selesai?')">
      <i class="bi bi-check2-circle"></i> Selesai
    </a>

    <a href="hapus_transaksi.php?id=<?= $trx['id']; ?>" 
     class="btn btn-sm btn-danger" 
     onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
    <i class="bi bi-trash"></i> Hapus
  </a>
  <?php else: ?>
    <span class="badge bg-success d-block mb-1">Transaksi Selesai</span>

    <a href="hapus_transaksi.php?id=<?= $trx['id']; ?>" 
   class="badge bg-danger d-block mb-1" 
   style="text-decoration: none;" 
   onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
  <i class="bi bi-trash"></i> Hapus
</a>

  <?php endif; ?>

  
</td>

            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" class="text-center text-muted">Belum ada transaksi.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#tabelTransaksi').DataTable();
    });
  </script>
</body>
</html>
