<?php 
require('../../db/conn.php');
require('../../App/loader.php');
$books = getBooksData($conn);
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
    <!-- membuat button untuk direct ke halaman create_user rata kanan -->
<!-- <div class="container border-2 absolute right-0">
    <div class="row">
        <div class="col-md-6">
            <a href="buku_create.php" class="btn btn-primary">Create User</a>
        </div>
    </div>
</div> -->
    <div id="wrapper" class="row">
        <?php include('partials/sidebar.php');?>
        <div class="container-fluid col-md-9">
            <div class="button-create btn btn-primary text-white mb-3 mt-3">
                <a href="buku_create.php" class="text-decoration-none text-white">Create Buku</a>
            </div>
            <h2>TABEL BUKU</h2>
            <hr>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Deskripsi</th>
                        <th>Genre</th>
                        <th>Penerbit</th>
                        <th>Ketersediaan</th>
                        <th style="width:15%">Aksi</th>
                    </tr>
            </thead>
            <tbody>
                <?php if($books != NULL): ?>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?= $book['judul'] ?></td>
                            <td><?= $book['penulis'] ?></td>
                            <td><?= $book['deskripsi'] ?></td>
                            <td><?= $book['jenis_genre'] ?></td>
                            <td><?= $book['penerbit'] ?></td>
                            <td><?= $book['status'] ?></td>
                            <td>
                                <a href="buku_update.php?ib=<?= $book['id_buku'] ?>" class="btn btn-primary m-1">Edit</a>
                                <a href="buku_single.php?ib=<?= $book['id_buku'] ?>" class="btn btn-success m-1">View</a>
                                <a href="buku_delete.php?ib=<?= $book['id_buku'] ?>" class="btn btn-danger m-1">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                <!-- Add more rows as needed -->
            </tbody>
            </table>
        </div>
    </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>