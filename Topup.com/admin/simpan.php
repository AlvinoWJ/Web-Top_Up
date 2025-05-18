<?php
$uploadDir = "image/"; // Ganti ke folder yang kamu punya

if (!is_dir($uploadDir)) {
  mkdir($uploadDir, 0777, true); // Buat folder jika belum ada (optional, bisa dihapus kalau folder sudah ada)
}

$nama = $_POST['nama'];
$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

$target = $uploadDir . basename($gambar);

// Simpan file
if (move_uploaded_file($tmp, $target)) {
  $data = [
    'nama' => $nama,
    'gambar' => $gambar
  ];

  $file = "data.json";
  $games = [];

  if (file_exists($file)) {
    $games = json_decode(file_get_contents($file), true);
  }

  $games[] = $data;
  file_put_contents($file, json_encode($games, JSON_PRETTY_PRINT));

  header("Location: index.php");
} else {
  echo "Gagal upload gambar.";
}
