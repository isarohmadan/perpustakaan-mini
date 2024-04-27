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

// check if the ig is available at the table 
$genre = null;

if(isset($_GET['ig'])){
    $id_genre = $_GET['ig'];
    $genre = getGenreData($conn,$id_genre);
    if($genre == null){
        // redirect ke halaman users    
        header('Location: users.php');
        die;
    }
    }

if(isset($_POST['submit'])){
    if(updateGenreData($conn,$_POST)){
        echo "<script> alert('Genre Berhasil Di Update!') 
        window.location.href = 'genre.php';
        </script>";
    }else{
        echo "<script> alert('Genre Gagal Di Update!') 
        window.location.href = 'genre.php';
        </script>";
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
     <!-- creating form genre using bootstrap-->
     <div class="container-fluid">
        <div class="row">
        <?php include('partials/sidebar.php');?>
            <div class="col-md-9 container-fluid">
            <div class="btn btn-danger text-white mb-3 mt-3">
                    <a href="genre.php" class="text-decoration-none text-white">Kembali</a>
                </div>
                <hr>
                <h2>Update User</h2>
                <form action="" method="POST">
                    <!-- id -->
                    <input type="hidden" name="id_genre" value="<?= $id_genre ?>">
                    <div class="form-group">
                        <label for="jenis_genre">jenis genre</label>
                        <input type="text" class="form-control" id="jenis_genre" name="jenis_genre" required value="<?= $genre[0]['jenis_genre'] ?>">
                    </div>
                    <!-- description -->
                    <div class="form-group">
                        <label for="description">deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description" required value="<?= $genre[0]['description'] ?>">
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>