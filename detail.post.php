<?php
include "koneksi.php";

$foto_id = $_GET['foto_id'];

$query = mysqli_query($koneksi, "SELECT * FROM foto WHERE foto_id = $foto_id LIMIT 1");
$row = mysqli_fetch_assoc($query);

$komentar_query = mysqli_query($koneksi, "SELECT * FROM komentar_foto WHERE foto_id = $foto_id");

function jumlah_like($foto_id){
    global $koneksi;
    $q = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_like FROM like_foto WHERE foto_id = $foto_id ");
    $row = mysqli_fetch_assoc($q);
    return $row['jumlah_like'];
}

function jumlah_komentar($foto_id){
    global $koneksi;
    $r = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_komentar FROM komentar_foto WHERE foto_id = $foto_id ");
    $row = mysqli_fetch_assoc($r);
    return $row['jumlah_komentar'];
}

function getKomentar($foto_id){
    global $koneksi;
    $s = mysqli_query($koneksi, "SELECT * FROM komentar_foto WHERE foto_id = $foto_id ");
    return mysqli_fetch_assoc($s);
}

function nama_user($user_id){
    global $koneksi;
    if (!$user_id){
        return 'anonym';
    }
    $r = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id = $user_id ");
    $row = mysqli_fetch_assoc($r);
    return $row['username'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <title>Galery Foto</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="">
                <div class="card-body">
                    <a href="index.php" class="btn btn-outline-dark">Home<i class='bx bxs-home'></i></a>
                    <?php if (isset($_SESSION['user']) && isset($_SESSION['user']['user_id'])) : ?>
                        <a href="tambah.php" class="btn btn-outline-dark">Unggah Foto<i class='bx bx-plus'></i></a>
                        <a href="profile.php" class="btn btn-outline-dark">Profile<i class='bx bx-user' ></i></a>
                    <?php else : ?>
                        <a href="register.php" class="btn btn-outline-dark">Register<i class='bx bx-user-plus' ></i></a>
                        <a href="login.php" class="btn btn-outline-dark">Login<i class='bx bx-log-in'></i></a>
                    <?php endif ; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-5 col-sm-6">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <div style="display: flex; flex-direction: column; gap: 25px;">
                        <div style="display: flex; flex-direction: column; border: 1 solid black; border-radius: 6px; max-width: 400px;">
                            <h1><?php echo $row['judul_foto']; ?></h1>
                            <p><?php echo $row['deskripsi_foto']; ?></p>
                            <p><?php echo $row['tgl_unggah']; ?></p>
                            <img src="gambar/<?php echo $row['lokasi_file']; ?>" alt="" style="width: 127%" />
                            <div class="mt-2" style="display:flex; align-items: center; gap: 20px;">
                                <a href="like.php?foto_id=<?= $row['foto_id'] ?>"><i class='bx bxs-heart'></i><?= jumlah_like($row['foto_id']) ?></a>
                                <a href="detail.post.php?foto_id=<?= $row['foto_id'] ?>"  ><i class='bx bxs-comment-detail'></i><?= jumlah_komentar($row['foto_id']) ?></a>
                                <?php if (isset($_SESSION['user']) && isset($_SESSION['user']['user_id'])) : ?>
                                    <a href="edit.php?foto_id=<?= $row['foto_id'] ?>" ><i class='bx bxs-edit-alt'></i></a>
                                    <a onclick="return confirm('Hapus Postingan ini?')" href="hapus.php?foto_id=<?= $row['foto_id'] ?>" ><i class='bx bxs-trash-alt'></i></a>
                                <?php endif ; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="tambahkomentar.php" method="post" class="mt-3" style="display: flex; flex-direction: column;  border-radius: 6px; max-width: 400px; margin: 0 auto; width: 100%; border-radius: 5rem;">
    <label for="isi_komentar">Tambah Komentar</label>
    <input type="hidden" name="foto_id" value="<?= $row['foto_id'] ?>">
    <input type="text" name="isi_komentar" placeholder="Isi komentar" height="10rem" style="height: 10rem; border-radius: 1rem"><br>
    <button type="submit" name="submit">Kirim</button>
</form>

<h3 style="text-align: center;">Komentar</h3>
<div class="card " style="display: flex; flex-direction: column;  border-radius: 6px; max-width: 400px; margin: 0 auto; width: 100%; border-radius: 2rem;">
    <div class="card-body">
        <?php while ($komentar = mysqli_fetch_assoc($komentar_query)) : ?>
            <i class='bx bx-subdirectory-right'></i>
            <div style="display: flex; flex-direction: column;  border-radius: 6px; max-width: 250px; margin: 0 auto; width: 100%; border-radius: 2rem;"> 
                <h5><?php echo nama_user($komentar['user_id']); ?></h5>
                <p><?php echo $komentar['tgl_komentar']; ?></p>
                <p><?php echo $komentar['isi_komentar']; ?></p>
            </div>
        <?php endwhile ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
