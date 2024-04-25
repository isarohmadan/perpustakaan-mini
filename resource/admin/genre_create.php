
<?php 
require('../../db/conn.php');
require('../../App/loader.php');


if(isset($_POST['submit'])){
    if(createGenreData($conn,$_POST)){
        echo "User berhasil dibuat";
    }else{
        echo "User gagal dibuat";
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
                <div class="btn btn-danger text-white mb-3 mt-3">
                    <a href="genre.php" class="text-decoration-none text-white">Kembali</a>
                </div>
                <hr>
                <h2>Create User</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="genre">genre</label>
                        <input type="text" class="form-control" id="genre" name="genre" required>
                    </div>
                    <div class="form-group">
                        <label for="description">deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description" required>
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
