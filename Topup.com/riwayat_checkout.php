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
  <?php if (empty($riwayat)) : ?>
    <div class="col-12">
      <div class="alert alert-info text-center" role="alert">
        Tidak ada transaksi yang ditemukan.
      </div>
    </div>
  <?php else: ?>
    <?php foreach($riwayat as $r): ?>
      <!-- Card Transaksi -->
      <div class="col-12 mb-4">
        <div class="card bg-dark text-white p-3 rounded-4 shadow-sm">
          <div class="row g-3 align-items-center">
            <!-- Konten transaksi seperti sebelumnya -->
            ...
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
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
