<?php
  include "koneksi.php";
  
  // if (empty($_SESSION['user'])) {
  //     header('location:login.php');
  // }  

  $query = mysqli_query($koneksi, "SELECT * FROM foto ORDER BY foto_id DESC");


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

  function nama_user($user_id)
  {
      global $koneksi;
      $r = mysqli_query($koneksi, "SELECT username FROM user WHERE user_id = $user_id");
      $row = mysqli_fetch_assoc($r);
      return $row['username'];
  }
  
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery</title>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body style="min-height: 100vh;">

   
  <?php if(isset($_SESSION['user_id'])); ?>
    <section class="card bg-secondary" style="margin: 1rem; padding: 1rem;min-height: 100vh;">
    <h1 class="text-center fw-bold">GALLERY FOTO</h1>
    <div class="container">
    <div class="row">
        <div class="col d-flex justify-content-center">
          <div class="">
            <div class="card-body">
            <a href="pengunjung.php" class="btn btn-outline-dark">Home<i class='bx bxs-home'></i></a>
            <?php if (isset($_SESSION['user']) && isset($_SESSION['user']['user_id'])) : ?>

            <a href="profilevisitor.php" class="btn btn-outline-dark">Profile<i class='bx bx-user' ></i></a>
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

    <div style="margin: 1rem; padding: 1rem;">
        <div class="container text-center">
          <div class="row d-flex flex-wrap">
              <!-- <div class="col-md-6 mx-auto"> -->
                <!-- <div class="row "> -->
                    <!-- <div class="col mb-4 "> -->
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM foto");
                        while ($row = mysqli_fetch_array($query)){
                        ?>
                        <div class="card mb-4 md-6 mx-auto" style="width: 18rem;"><br>
                            <img src="gambar/<?php echo $row['lokasi_file']; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['judul_foto']; ?></h5>
                                <p class="card-text"><?php echo $row['deskripsi_foto']; ?></p>
                                <p class="fw-light"><?php echo $row['tgl_unggah']; ?></p>

                               
                                <a href="like.php?foto_id=<?= $row['foto_id'] ?>"><i class='bx bxs-heart'></i><?= jumlah_like($row['foto_id']) ?></a>
                                <a href="commentvisitor.php?foto_id=<?= $row['foto_id'] ?>"  ><i class='bx bxs-comment-detail'></i><?= jumlah_komentar($row['foto_id']) ?></a>


                                


                            </div>
                        </div>
                        <?php } ?>
                    <!-- </div> -->
                <!-- </div> -->
                <!-- </div> -->
          </div>
        </div>
    </div>


                          

    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>