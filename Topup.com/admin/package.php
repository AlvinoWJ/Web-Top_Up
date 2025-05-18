<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Game</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>
<body>
<?php include 'components/sidebar.php';?>
<div class="container p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Package</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPackage"><i class="bi bi-plus-lg"></i>
      Tambah Package
    </button>

  </div>

  <div class="modal fade" id="modalTambahPackage" tabindex="-1" aria-labelledby="modalTambahPackageLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahPackageLabel">Tambah Package Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
            <div class="mb-3">
              <label for="jenis_game" class="form-label">Jenis Game</label>
              <select class="form-select" id="jenis_game" name="jenis_game" required>
                <option value="" disabled selected>Pilih Jenis Game</option>
                <option value="Mobile Legends">Mobile Legends</option>
                <option value="Free Fire">Free Fire</option>
                <option value="PUBG Mobile">PUBG Mobile</option>
                <option value="Valorant">Valorant</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="nama_paket" class="form-label">Nama Paket</label>
              <input type="text" class="form-control" id="nama_paket" name="nama_paket" required>
            </div>

            <div class="mb-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="number" class="form-control" id="harga" name="harga" required>
            </div>

            <div class="mb-3">
              <label for="jumlah_item" class="form-label">Jumlah Item</label>
              <input type="number" class="form-control" id="jumlah_item" name="jumlah_item" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
