<?php
session_start();
include '../function.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: package.php");
    exit;
}

$id = $_GET['id'];

$query = "DELETE FROM paket WHERE id = $id";
if (mysqli_query($database, $query)) {
    echo "<script>alert('Data berhasil dihapus'); window.location.href = 'package.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data');</script>";
    echo mysqli_error($database);
}
?>
