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

// check if the iu is available at the table 
$user = null;

if(isset($_GET['iu'])){
    $id_user = $_GET['iu'];
    $user = getUserDataById($conn,$id_user);
    if($user == null){
        // redirect ke halaman users    
        header('Location: users.php');
        die;
    }
    }

if(isset($_POST['submit'])){
    if(updateUserData($conn,$_POST)){
        echo "<script> alert('User Berhasil Di Update!') 
        window.location.href = 'users.php';
        </script>";
    }else{
        echo "<script> alert('User Gagal Di Update!') 
        window.location.href = 'users.php';
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
     <!-- creating form user using bootstrap-->
     <div class="container-fluid">
        <div class="row">
        <?php include('./partials/sidebar.php') ?>
            <div class="col-md-8 container-fluid">
                <div class="button-create btn btn-danger text-white mb-3 mt-3">
                    <a href="users.php" class="text-decoration-none text-white">Kembali</a>
                </div>
                <hr>
                <h2>Update User</h2>
                <form action="" method="POST">
                    <!-- id -->
                    <input type="hidden" name="id_user" value="<?= $id_user ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required value="<?= $user['nama_user'] ?>">
                    </div>
                    <!-- email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="<?= $user['email'] ?>">
                    </div>
                    <!-- alamat -->
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required value="<?= $user['alamat'] ?>">
                    </div>
                    <!-- nomor -->
                    <div class="form-group">
                        <label for="nomor">Nomor</label>
                        <input type="text" class="form-control" id="nomor" name="nomor" required value="<?= $user['nama_user'] ?>" >
                    </div>
                    <div class="form-group" >
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control" id="level" name="level" required>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>