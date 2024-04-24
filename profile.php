<?php 
include "koneksi.php";

$user_id = $_SESSION['user']['user_id'];

$query = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id= $user_id LIMIT 1");

$user = mysqli_fetch_assoc($query);

$post_query = mysqli_query($koneksi, "SELECT * FROM foto WHERE user_id = $user_id");

function jumlah_like($foto_id){
  global $koneksi;
  $foto_id = mysqli_real_escape_string($koneksi, $foto_id); // Melakukan sanitasi input
  $q = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_like FROM like_foto WHERE foto_id = '$foto_id'");
  $row = mysqli_fetch_assoc($q);
  return $row['jumlah_like'];
}

function jumlah_komentar($foto_id){
  global $koneksi;
  $foto_id = mysqli_real_escape_string($koneksi, $foto_id); // Melakukan sanitasi input
  $r = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_komentar FROM komentar_foto WHERE foto_id = '$foto_id'");
  $row = mysqli_fetch_assoc($r);
  return $row['jumlah_komentar'];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  </head>
  <body>

  <div class="container">
    <div class="row">
        <div class="col d-flex justify-content-center mt-4">
          <div class="">
            <div class="card-body">
            <a href="index.php" class="btn btn-outline-dark">Home<i class='bx bxs-home'></i></a>
            <?php if (isset($_SESSION['user']) && isset($_SESSION['user']['user_id'])) : ?>

              <a href="tambah.php" class="btn btn-outline-dark">Unggah Foto<i class='bx bx-plus'></i></a>
              <a href="profile.php" class="btn btn-outline-dark">Profile<i class='bx bx-user' ></i></a>
              <a href="logout.php" class="btn btn-outline-dark">Logout<i class='bx bx-log-out' ></i></a>
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

    <section class="col-md-6 mx-auto mt-4 mb-2" style="width: 20rem;">
    <div class="container ">
    <div class="row">
        <div class="col mx-auto" style="width: 20rem;">
          <div class="card text-white" style="background-color: #8EACCD;">
            <div class="card-body">
              <div class="col d-flex justify-content-center">
              <i class='bx bx-user-circle bx-lg'></i>
              </div>
              <h4 class="card-title"> Username:
              <?php echo $user['username']; ?></h4>
              <h4 class="card-title"> Email:
              <?php echo $user['email']; ?></h4>
              <h4 class="card-title"> Nama Lengkap:
              <?php echo $user['nama_lengkap']; ?></h4>
              <h4 class="card-title"> Alamat:
              <?php echo $user['alamat']; ?></h4>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
</section>

<div style="margin: 1rem; padding: 1rem;">
        <div class="container text-center">
          <div class="row d-flex flex-wrap">
   
      <?php while ($row = mysqli_fetch_assoc($post_query)): ?>
     
      <div class="card mb-4 md-6 mx-auto" style="width: 18rem;"><br>
                        <img src="gambar/<?php echo $row['lokasi_file']; ?>" class="card-img-top" alt="..." style="border-radius: 0.5rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['judul_foto']; ?></h5>
                            <p class="card-text"><?php echo $row['deskripsi_foto']; ?></p>
                            <p class="fw-light"><?php echo $row['tgl_unggah']; ?></p>

                            <a href="like.php?foto_id=<?= $row['foto_id'] ?>"><i class='bx bxs-heart' color="red"></i><?= jumlah_like($row['foto_id']) ?></a>

                            <a href="detail.post.php?foto_id=<?= $row['foto_id'] ?>"  ><i class='bx bxs-comment-detail'></i><?= jumlah_komentar($row['foto_id']) ?></a></a>


                            <a href="edit.php?foto_id=<?= $row['foto_id'] ?>" ><i class='bx bxs-edit-alt'></i></a>
                                <a onclick="return confirm('Hapus Postingan ini?')" href="hapus.php?foto_id=<?= $row['foto_id'] ?>" ><i class='bx bxs-trash-alt'></i></a>
                        </div>
     </div>
      
      <?php endwhile; ?>
    </div>
  </div>
 </div>
 


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>