<?php
include "koneksi.php";

$foto_id = $_GET['foto_id'];

$query = mysqli_query($koneksi, "SELECT * FROM foto WHERE foto_id = $foto_id LIMIT 1");
$foto = mysqli_fetch_assoc($query);

if(isset($_POST['submit'])) {
    $judul_foto = $_POST['judul_foto'];
    $deskripsi_foto = $_POST['deskripsi_foto'];

    // Cek jika ada file yang diupload
    if(isset($_FILES['lokasi_file']) && $_FILES['lokasi_file']['error'] === UPLOAD_ERR_OK) {
        $tmp_file = $_FILES['lokasi_file']['tmp_name'];
        $filename = uniqid().'_'. $_FILES['lokasi_file']['name'];
        move_uploaded_file($tmp_file, './gambar/'. $filename);
    } else {
        // Jika tidak ada file yang diupload, gunakan file yang sudah ada sebelumnya
        $filename = $foto['lokasi_file'];
    }

    $query_update = mysqli_query($koneksi, "UPDATE foto SET judul_foto = '$judul_foto', deskripsi_foto = '$deskripsi_foto', lokasi_file = '$filename' WHERE foto_id = $foto_id");

    if($query_update) {
        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert('Update Foto Gagal!')</script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Foto</title>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center fw-bold">UPDATE FOTO</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="lokasi_file" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="lokasi_file" name="lokasi_file">
                            </div>
                            <div class="mb-3">
                                <label for="judul_foto" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul_foto" name="judul_foto" value="<?php echo $foto['judul_foto']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi_foto" class="form-label">Deskripsi</label>
                                <textarea class="form-control form-control-lg" id="deskripsi_foto" name="deskripsi_foto"><?php echo $foto['deskripsi_foto']; ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-warninng" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
