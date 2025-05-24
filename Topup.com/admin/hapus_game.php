<?php
session_start();
include '../function.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan.";
    exit;
}

$id = $_GET['id'];
$game = ambilData("SELECT * FROM games WHERE id = $id")[0];

if (!$game) {
    echo "Data tidak ditemukan.";
    exit;
}

// Hapus file gambar jika ada
if (!empty($game['icon_game']) && file_exists($game['icon_game'])) {
    unlink($game['icon_game']);
}

// Hapus data dari database
global $database;
$query = "DELETE FROM games WHERE id = $id";
if (mysqli_query($database, $query)) {
    echo "<script>alert('Data berhasil dihapus'); window.location.href = 'game.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data'); window.location.href = 'game.php';</script>";
}
?>
