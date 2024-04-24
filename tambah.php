<?php
include "koneksi.php";

if(isset($_POST['submit'])) {
    $judul_foto = $_POST['judul_foto'];
    $deskripsi_foto = $_POST['deskripsi_foto'];
    
    $user_id = $_SESSION['user']['user_id'];
    $tgl_unggah = date('Y-m-d');

    $tmp_file = $_FILES['lokasi_file']['tmp_name'];
    $nama_file = uniqid().'_'. $_FILES['lokasi_file']['name'];

    move_uploaded_file($tmp_file, './gambar/'. $nama_file);

    $query = mysqli_query($koneksi, "INSERT INTO foto VALUES('','$judul_foto','$deskripsi_foto','$tgl_unggah','$nama_file','$user_id')");

    if($query) {
        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert('Unggah Foto Gagal!')</script>";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah</title>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <h1 class="text-center fw-bold">UNGGAH FOTO</h1>
  <div class="container">
    <div class="row">
        <div class="col d-flex justify-content-center mb-2">
          <div class="">
            <div class="card-body">
            <a href="index.php" class="btn btn-outline-dark">Home<i class='bx bxs-home'></i></a>
            <?php if (isset($_SESSION['user']) && isset($_SESSION['user']['user_id'])) : ?>

              <a href="tambah.php" class="btn btn-outline-dark">Unggah Foto<i class='bx bx-plus'></i></a>
              <a href="profile.php" class="btn btn-outline-dark">Profile<i class='bx bx-user' ></i></a>
              <?php else : ?>

              <a href="register.php" class="btn btn-outline-dark">Register<i class='bx bx-user-plus' ></i></a>
              <a href="login.php" class="btn btn-outline-dark">Login<i class='bx bx-log-in'></i></i></a>
              <?php endif ; ?>

            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  <div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card bg-dark text-white">
            <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="lokasi_file" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="lokasi_file" aria-describedby="emailHelp" name="lokasi_file">
                </div>
                <div class="mb-3">
                    <label for="judul_foto" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul_foto" aria-describedby="emailHelp" name="judul_foto">
                </div>
                <div class="mb-3">
                    <label for="deskripsi_foto" class="form-label">Deskripsi</label>
                    <textarea class="form-control form-control-lg" id="deskripsi_foto" name="deskripsi_foto"></textarea>
                </div>
                
                <button type="submit" class="btn btn-warning" name="submit">Submit</button>
            </form>

            </div>
          </div>
        </div>
      </div>
    </div>
 


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
