<?php
include "koneksi.php";

$foto_id = $_POST['foto_id'];
$isi_komentar = $_POST['isi_komentar'];
$tgl_komentar = date('Y-m-d');

if(empty($_SESSION['user'])) {
    mysqli_query($koneksi, "INSERT INTO komentar_foto (foto_id, isi_komentar, tgl_komentar) VALUES ('$foto_id', '$isi_komentar', '$tgl_komentar')");

} else{
  
$user_id = $_SESSION['user']['user_id'] ;      
mysqli_query($koneksi, "INSERT INTO komentar_foto (user_id, foto_id, isi_komentar, tgl_komentar) VALUES ($user_id, '$foto_id', '$isi_komentar', '$tgl_komentar')");

}

echo "<script>
    window.location= 'detail.post.php?foto_id=$foto_id';
</script>";
?>