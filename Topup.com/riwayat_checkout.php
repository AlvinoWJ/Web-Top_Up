<?php
include 'function.php';
session_start();

// Pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$message = null;
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$riwayat = ambilData("SELECT 
  transaksi.*, 
  paket.nama_paket, paket.jumlah_item, paket.nama_item, paket.harga,
  games.name AS nama_game, games.icon_game
FROM transaksi
JOIN users on transaksi.user_id = users.id
JOIN paket ON transaksi.paket_id = paket.id
JOIN games ON paket.game_id = games.id
WHERE transaksi.user_id = {$_SESSION['user_id']};"); // jika login digunakan
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CincaStore - Riwayat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'partials/navbar.php'; ?>

<div class="container mt-5">


<!-- Toast Container -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100;">
  <div id="liveToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        <?= htmlspecialchars($message ?? '') ?>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var message = <?= json_encode($message) ?>;
  if (message) {
    var toastEl = document.getElementById('liveToast');
    var toast = new bootstrap.Toast(toastEl, { delay: 3000 }); // muncul 3 detik
    toast.show();
  }
});
</script>



  <h3 class="text-white mb-4">Riwayat Transaksi</h3>

  <div class="row g-4">
    <?php foreach($riwayat as $r): ?>
       
        <div class="col-12 mb-4">
  <div class="card bg-dark text-white p-3 rounded-4 shadow-sm">
    <div class="row g-3 align-items-center">
      <!-- Gambar Game -->
      <div class="col-auto">
        <img src="admin/<?= $r['icon_game']; ?>" alt="Game Icon" style="width: 90px; height: 90px; object-fit: cover;" class="rounded">
      </div>

      <!-- Informasi Transaksi -->
      <div class="col">
        <h5 class="mb-1"><?= $r['nama_game']; ?> - <?= $r['nama_paket']; ?></h5>
        <p class="mb-1"><?= $r['jumlah_item']; ?> <?= $r['nama_item']; ?> - Rp<?= number_format($r['harga'], 0, ',', '.'); ?></p>
            <p class="mb-1">Player ID: <strong><?= $r['player_id']; ?></strong> | Server ID: <strong><?= $r['server_id']; ?></strong></p>
        <p class="mb-1"><?= $r['metode_pembayaran']; ?></p>
        <p class="mb-1">Status: 
          <span class="badge 
          <?php if($r['status'] == 'belum_dibayar') : ?> bg-secondary
            <?php elseif($r['status'] == 'proses') : ?> bg-warning
                <?php elseif($r['status'] == 'selesai') : ?> bg-success
                    <?php else : ?> bg-danger
                        <?php endif ?>
          ">
            <?= $r['status']; ?>
          </span>
        </p>
        <small class="text-muted"><?= $r['waktu']; ?></small>
      </div>

      <!-- Tombol Upload -->
      <div class="col-auto text-end">
        

        <?php if ($r['bukti_bayar']) : ?>
          <a href="<?= $r['bukti_bayar']; ?>" target="_blank" class="btn btn-sm btn-success mt-2 d-block">Lihat Bukti</a>
          <?php if($r['status'] != 'selesai') : ?>
        <button 
            class="btn btn-outline-info btn-sm d- mt-3"
            data-bs-toggle="modal" 
            data-bs-target="#editBuktiModal" 
            data-id="<?= $r['id']; ?>">
            Edit Bukti
        </button>
        <?php endif; ?>
          <?php else: ?>
            <button 
          class="btn btn-outline-warning btn-sm" 
          data-bs-toggle="modal" 
          data-bs-target="#uploadBuktiModal" 
          data-id="<?= $r['id']; ?>">
          Upload Bukti
        </button>
        <?php endif; ?> 
      </div>
    </div>
  </div>
</div>


    <?php endforeach; ?>
</div>


<!-- Modal Upload Bukti -->
<div class="modal fade" id="uploadBuktiModal" tabindex="-1" aria-labelledby="uploadBuktiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="upload_bukti.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="transaksi_id" id="transaksiIdInput">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title" id="uploadBuktiModalLabel">Upload Bukti Pembayaran</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="bukti" class="form-label">Pilih Gambar</label>
            <input type="file" class="form-control" name="bukti" id="bukti" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Upload</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>



<div class="modal fade" id="editBuktiModal" tabindex="-1" aria-labelledby="editBuktiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="upload_bukti.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="transaksi_id" id="editTransaksiIdInput">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title" id="editBuktiModalLabel">Edit Bukti Pembayaran</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="bukti" class="form-label">Ganti Gambar</label>
            <input type="file" class="form-control" name="bukti" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>




</div>

<?php include 'partials/footer.php'; ?>

<script>
  const uploadModal = document.getElementById('uploadBuktiModal');
  uploadModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const transaksiId = button.getAttribute('data-id');
    const input = document.getElementById('transaksiIdInput');
    input.value = transaksiId;
  });


  const editModal = document.getElementById('editBuktiModal');
  editModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const transaksiId = button.getAttribute('data-id');
    document.getElementById('editTransaksiIdInput').value = transaksiId;
  });

</script>


</body>
</html>
