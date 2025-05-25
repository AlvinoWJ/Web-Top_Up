<?php
session_start();
include '../function.php';

// Inisialisasi array game jika belum ada
if (!isset($_SESSION['username']) && $_SESSION['role_id'] != 1) {
    header("Location: /Web-top_up/topup.com/login.php");
    exit;
}

$data_game =  ambilData("SELECT * FROM games");

// Tangani form jika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nama'], $_FILES['gambar'])) {
  $nama = htmlspecialchars($_POST['nama']);
  $deskripsi = isset($_POST['deskripsi']) ? htmlspecialchars($_POST['deskripsi']) : '';

  // Proses upload gambar
  $uploadDir = 'uploads/';
  if (!is_dir($uploadDir)) {
    mkdir($uploadDir);
  }

  $gambarName = basename($_FILES['gambar']['name']);
  $targetPath = $uploadDir . time() . '_' . $gambarName;

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
    $newGame = [
        'nama' => $nama,
        'deskripsi' => $deskripsi,
        'gambar' => $targetPath
    ]; }

    if(tambahDataGame($newGame) > 0){

        echo "<script>
            alert('Data berhasil ditambahkan')
        </script>";
        } else{
        echo "<script>
            alert('Data tidak ditambahkan')
        </script>";
        echo mysqli_error($database);
        }

        echo "
        <script>
            document.location.href = 'game.php';
        </script>
        ";
    
    
    }


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
  <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">


</head>
<body>
    <?php include 'components/sidebar.php'; ?>

<div class="container p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Game</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahGameModal">
        <i class="bi bi-plus-lg"></i> Tambah Game
        </button>
    </div>

    <table id="tabelGame" class="table table-light table-striped">
        <thead>
            <tr>
                <th>no</th>
                <th>Nama Game</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data_game)): ?>
                <?php foreach ($data_game as $i => $game): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $game['name'] ?></td>
                        <td> 
                            <?php if ( $game['icon_game'] != ''): ?>
                            <img src="<?= $game['icon_game'] ?>" alt="Gambar Game" style="max-width: 100px;">
                            <?php else: ?>
                            <span class="text-muted">Tidak ada gambar</span>
                            <?php endif; ?>
                        </td>
                       <td>
                            <a href="edit_game.php?id=<?= $game['id'] ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="hapus_game.php?id=<?= $game['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus game ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>



                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3">Belum ada data game yang ditambahkan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="tambahGameModal" tabindex="-1" aria-labelledby="tambahGameLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahGameLabel">Tambah Game Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Game</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Masukkan Gambar</label>
                        <input class="form-control" type="file" id="formFile" name="gambar" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function () {
    $('#tabelGame').DataTable({
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
