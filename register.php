<?php
include "koneksi.php";

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "INSERT INTO user (username, nama_lengkap, email, alamat, password) VALUES ('$username', '$nama_lengkap', '$email', '$alamat', '$password')");

    if ($query) {
        echo '<script>alert("Register berhasil, silahkan login"); location.href ="login.php"</script>';
    } else {
        echo '<script>alert("Register gagal")</script>';
}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
  .login-signup {
	margin: 10px;
	text-decoration: none;
	float: right;
}

.login-signup a {
	text-decoration: none;
	font-weight: 700;
}
</style> 
  </head>
  <body>

<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <form action="" method="post">
            <div class="mb-md-5 mt-md-4 pb-5">
            <div class="login-signup">
        				<a href="index.php" style="color: white;">Home</a>
      			</div><br><br><br>
              <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
              
              <div class="form-outline form-white mb-4">
                <input type="text" id="nama_lengkap" class="form-control form-control-lg" name="nama_lengkap" placeholder="Nama Lengkap"/>
                
              </div>

              <div class="form-outline form-white mb-4">
            <textarea class="form-control form-control-lg" id="exampleTextarea"  placeholder="Alamat" name="alamat"></textarea>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="email" id="email" class="form-control form-control-lg" name="email" placeholder="Email"/>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="text" id="username" class="form-control form-control-lg" name="username" placeholder="Username"/>
    
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="Password"/>

              </div>

             
              <button class="btn btn-outline-light btn-lg px-5" type="submit">Register</button>

            </div>

            <div>
              <p class="mb-0">Already have an account? <a href="login.php" class="text-white-50 fw-bold">Login!</a>
              </p>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>