<?php 
require_once '../../App/loader.php';
require_once '../../db/conn.php';

$genres = getGenreData($conn);

// check if the iu is available at the table 
$book = null;

if(isset($_GET['ib'])){
    $id_book = $_GET['ib'];
    $book = getBooksData($conn,$id_book);
    if($book == null){
        // redirect ke halaman bookss    
        header('Location: buku.php');
        die;
    }
    }

if(isset($_POST['submit'])){
    if(updatebookData($conn,$_POST)){
        echo "books berhasil dibuat";
    }else{
        echo "books gagal dibuat";
    }
}


?>


<!DOCTYPE html>
<html>
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
                <div class="btn btn-danger text-white mb-3 mt-3">
                    <a href="users.php" class="text-decoration-none text-white">Kembali</a>
                </div>
                <hr>
                <h2>Update Buku</h2>
                <form action="" method="POST">
                    <!-- id -->
                    <input type="hidden" name="id_buku" value="<?= $id_book ?>">
                    <div class="form-group">
                        <label for="judul">Judul Buku</label>
                        <input type="text" class="form-control" id="judul" name="judul" required value="<?= $book[0]['judul'] ?>">
                    </div>
                    <!-- description -->
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <input type="textfield" class="form-control" id="description" name="description" required value="<?= $book[0]['deskripsi'] ?>">
                    </div>
                    <!-- penulis -->
                    <div class="form-group">
                        <label for="penulis">Penulis Buku</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" required value="<?= $book[0]['penulis'] ?>">
                    </div>
                    <!-- penerbit -->
                    <div class="form-group">
                        <label for="penerbit">Penerbit Buku</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" required value="<?= $book[0]['penerbit'] ?>">
                    </div>
                    <div class="form-group" >
                        <label for="supplier">Supplier Buku</label>
                        <input type="supplier" class="form-control" id="supplier" name="supplier" required value="<?= $book[0]['supplier'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <select class="form-control" id="genre" name="genre" required>
                        <?php if($genres != NULL): ?>
                            <option value='' selected disabled hidden>Choose option</option>    
                            <?php foreach($genres as $genre): ?>
                                <option value="<?= $genre['id_genre'] ?>"><?= $genre['jenis_genre'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                                <option value='' selected disabled hidden>Choose option</option>
                                <option default value="available">tersedia</option>
                                <option value="unavailable">tidak tersedia</option>
                        </select>
                    </div>
                    <div class="button-create btn btn-primary text-white mb-3 mt-3">
                    <a href="" class="text-decoration-none text-white">Create Buku</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

