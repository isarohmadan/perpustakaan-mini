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

    $users = getUserData($conn);

?>


<!DOCTYPE html>
<html lang="idn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./asset/index.css">
</head>
<body>

<!-- membuat button untuk direct ke halaman create_user rata kanan -->
<!-- <div class="container border-2 absolute right-0">
    <div class="row">
        <div class="col-md-6">
            <a href="create_user.php" class="btn btn-primary">Create User</a>
        </div>
    </div>
</div> --> 
<div class="row" id="kontol">
        <?php include('partials/sidebar.php');?>
            <div class="container-fluid table-buku col-md-9">
            <div class="button-create btn btn-primary text-white mb-3 mt-3">
                <a href="create_user.php" class="text-decoration-none text-white">Create User</a>
            </div>
            <h2>TABEL USERS</h2>
            <hr>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nama User</th>
                                <th>Email</th>
                                    <th>Alamat</th>
                                <th>Nomor</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                <tbody>
            <?php if($users != NULL): ?>
                <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['nama_user'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['alamat'] ?></td>
                            <td><?= $user['nomor'] ?></td>
                            <td>
                                <a href="update_user.php?iu=<?= $user['id_user'] ?>" class="btn btn-primary">Edit</a>
                                <a href="update_user.php?iu=<?= $user['id_user'] ?>" class="btn btn-success">View</a>
                                <a href="delete_user.php?iu=<?= $user['id_user'] ?>" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                <?php endforeach; ?>
            <?php endif; ?>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
</div>
</div>

</body>
</html>