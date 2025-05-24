<?php
session_start();
include '../function.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID game tidak ditemukan.";
    exit;
}

$id = $_GET['id'];
$game = ambilData("SELECT * FROM games WHERE id = $id")[0];

if (!$game) {
    echo "Data tidak ditemukan.";
    exit;
}

// Handle update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nama'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $deskripsi = isset($_POST['deskripsi']) ? htmlspecialchars($_POST['deskripsi']) : $game['deskripsi'];
    $gambarPath = $game['icon_game'];

    // Jika user upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir);
        }

        $gambarName = basename($_FILES['gambar']['name']);
        $targetPath = $uploadDir . time() . '_' . $gambarName;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
        // Hapus gambar lama jika ada dan file-nya memang tersimpan di server
        if (file_exists($game['icon_game'])) {
            unlink($game['icon_game']);
        }
        $gambarPath = $targetPath;
        }

    }

    $query = "UPDATE games SET 
                name = '$nama',
                deskripsi = '$deskripsi',
                icon_game = '$gambarPath'
              WHERE id = $id";

    global $database;
    if (mysqli_query($database, $query)) {
        echo "<script>alert('Data berhasil diperbarui'); window.location.href = 'game.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data');</script>";
        echo mysqli_error($database);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Game</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nama Game</label>
            <input type="text" class="form-control" name="nama" value="<?= $game['name'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi"><?= $game['deskripsi'] ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar Sekarang</label><br>
            <?php if ($game['icon_game']): ?>
                <img src="<?= $game['icon_game'] ?>" style="max-width: 100px;">
            <?php else: ?>
                <span class="text-muted">Tidak ada gambar</span>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Upload Gambar Baru (Opsional)</label>
            <input type="file" class="form-control" name="gambar">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="game.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
