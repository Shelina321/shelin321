<?php
include "koneksi.php";

if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek = mysqli_query($koneksi, "SELECT * FROM user where username = '$username' and password = '$password'");

    if(mysqli_num_rows($cek) > 0 ) {
        $row = mysqli_fetch_assoc($cek);
        $_SESSION['user'] = $row;
        echo '<script>alert("Selamat datang '.$row['nama_lengkap'].'"); 
        location.href ="pengunjung.php"</script>';
    } else {
        echo '<script>alert("Username/Password Salah!")</script>';
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div class="form-outline form-white mb-4">
                <input type="username" id="username" class="form-control form-control-lg" name="username" placeholder="username"/>
                <label class="form-label" for="username">username</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="Password"/>
                <label class="form-label" for="password">Password</label>
              </div>

              <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

              <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

            </div>

            <div>
              <p class="mb-0">Don't have an account? <a href="registervisitor.php" class="text-white-50 fw-bold">Sign Up</a>
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