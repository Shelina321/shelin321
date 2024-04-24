<?php
include = "koneksi.php";

// Mendapatkan foto_id dari request POST
$foto_id = $_POST['foto_id'];
$isi_komentar = $_POST['isi_komentar'];
$tanggal_komentar = date('Y-m-d');

// Tentukan ID pengguna anonim
$anonymous_user_id = 1; // Misalnya, menggunakan ID 1 sebagai ID pengguna anonim

// Insert komentar ke dalam tabel komentar_foto dengan ID pengguna anonim
$query = mysqli_query($koneksi, "INSERT INTO komentar_foto (user_id, foto_id, isi_komentar, tanggal_komentar) VALUES ('$anonymous_user_id', '$foto_id', '$isi_komentar', '$tanggal_komentar')");

// Redirect kembali ke halaman detail-post setelah operasi selesai
header("Location: detail-post.php?foto_id=$foto_id");
exit;



?>