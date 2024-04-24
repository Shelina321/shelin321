<?php
include "koneksi.php";

$foto_id = $_GET['foto_id'];

mysqli_query($koneksi, "DELETE FROM foto WHERE foto_id = $foto_id");

header('Location: '.$_SERVER['HTTP_REFERER']);

?>