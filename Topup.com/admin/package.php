<?php
session_start();
include '../function.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ambil data game untuk dropdown
$games = ambilData("SELECT * FROM games");

// Ambil data semua package dan join ke tabel games
$data_package = ambilData("SELECT paket.*, games.name AS nama_game FROM paket 
                           LEFT JOIN games ON paket.game_id = games.id");

// Proses tambah package
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    global $database;

    $game_id = $_POST['jenis_game'];
    $nama_paket = htmlspecialchars($_POST['nama_paket']);
    $harga = intval($_POST['harga']);
    $jumlah_item = intval($_POST['jumlah_item']);
    $nama_item = isset($_POST['nama_item']) ? htmlspecialchars($_POST['nama_item']) : '';

    $query = "INSERT INTO paket (game_id, nama_paket, harga, jumlah_item, nama_item)
              VALUES ('$game_id', '$nama_paket', '$harga', '$jumlah_item', '$nama_item')";

    if (mysqli_query($database, $query)) {
        echo "<script>alert('Package berhasil ditambahkan'); window.location.href = 'package.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan package');</script>";
        echo mysqli_error($database);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Package</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

</head>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>




<body>
<?php include 'components/sidebar.php';?>

<div class="container p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Package</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPackage">
      <i class="bi bi-plus-lg"></i> Tambah Package
    </button>
  </div>

  <!-- Tabel Package -->
  <div class="table-responsive mt-4">
  <table id="tabelPackage" class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Game</th>
        <th>Nama Paket</th>
        <th>Harga</th>
        <th>Jumlah Item</th>
        <th>Nama Item</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // $data_package = ambilData("
      //   SELECT p.*, g.name as nama_game 
      //   FROM paket p 
      //   JOIN games g ON p.game_id = g.id
      // ");
      foreach ($data_package as $i => $row):
      ?>
      <tr>
        <td><?= $i + 1 ?></td>
        <td><?= $row['nama_game'] ?></td>
        <td><?= $row['nama_paket'] ?></td>
        <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
        <td><?= $row['jumlah_item'] ?></td>
        <td><?= $row['nama_item'] ?></td>
        <td>
          <a href="edit_package.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="hapus_package.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus data ini?')">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>


  <!-- Modal Tambah Package -->
  <div class="modal fade" id="modalTambahPackage" tabindex="-1" aria-labelledby="modalTambahPackageLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTambahPackageLabel">Tambah Package Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="jenis_game" class="form-label">Jenis Game</label>
              <select class="form-select" id="jenis_game" name="jenis_game" required>
                <option value="" disabled selected>Pilih Jenis Game</option>
                <?php foreach ($games as $game): ?>
                  <option value="<?= $game['id'] ?>"><?= $game['name'] ?></option>
                <?php endforeach; ?>
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

            <div class="mb-3">
              <label for="nama_item" class="form-label">Nama Item</label>
              <input type="text" class="form-control" id="nama_item" name="nama_item">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function () {
    $('#tabelPackage').DataTable({
      responsive: true,
      language: {
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ data",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        paginate: {
          previous: "Sebelumnya",
          next: "Berikutnya"
        }
      }
    });
  });
</script>
</body>
</html>
