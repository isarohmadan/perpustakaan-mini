
<?php 
session_start();
require('../../db/conn.php');
require('../../App/loader.php');

if(isUserLoggedIn() == false){
    header('Location: ../../auth/login.php');
    exit;
}
if(isUserAdmin($conn) == false){
    header('Location: ../user/index.php');
    exit;
}


$genres=getGenreData($conn);

if(isset($_POST['submit'])){
    if(createBooksData($conn,$_POST,$_FILES)){
        echo "<script> alert('Buku Berhasil Di Buat!') 
        window.location.href = 'buku.php';
        </script>";
        // header('location: buku.php');
    }else{
        echo "<script> alert('Buku Gagal Di Buat!')
        window.location.href = 'buku.php';
        </script>";
        // header('location: buku.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./asset/index.css">
</head>
<body>
    <!-- creating form user using bootstrap-->
    <div class="container-fluid">
        <div class="row">
            <?php include('./partials/sidebar.php') ?>
            <div class="col-md-9 container-fluid">
                <div class="button-create btn btn-warning text-white mb-3 mt-3">
                    <a href="buku.php" class="text-decoration-none text-white">Kembali</a>
                </div>
                <hr>
                <h2>Create Buku</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="judul">Judul Buku</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <!-- description -->
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <input type="textfield" class="form-control" id="description" name="description" required>
                    </div>
                    <!-- penulis -->
                    <div class="form-group">
                        <label for="penulis">Penulis Buku</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" required>
                    </div>
                    <!-- penerbit -->
                    <div class="form-group">
                        <label for="penerbit">Penerbit Buku</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                    </div>
                    <div class="form-group" >
                        <label for="supplier">Supplier Buku</label>
                        <input type="supplier" class="form-control" id="supplier" name="supplier" required>
                    </div>
                    <div class="mb-3">
                        <label for="file_pdf" class="form-label">Upload Buku</label>
                        <input class="form-control form-control-sm" name="pdf-file" id="file_pdf" type="file">
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <select class="form-control" id="genre" name="genre" required>
                        <?php if($genres != NULL): ?>
                            <?php foreach($genres as $genre): ?>
                                <option value="<?= $genre['id_genre'] ?>"><?= $genre['jenis_genre'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                                <option default value="available">tersedia</option>
                                <option value="unavailable">tidak tersedia</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>


</html>
