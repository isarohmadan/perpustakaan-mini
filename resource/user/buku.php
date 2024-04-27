<?php 
session_start();
require('../../db/conn.php');
require('../../App/loader.php');

if(isUserLoggedIn() == false){
    header('Location: ../../auth/login.php');
    exit;
}
if(isUser($conn) == false){
    header('Location: ../../auth/login.php');
    exit;
}

$books = getBooksWithAvailableStatus($conn);
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

    <div id="wrapper" class="row">
        <?php include('partials/sidebar.php');?>
        <div class="container-fluid col-md-9 mt-5">
            <h2>TABEL BUKU</h2>
            <hr>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
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
                    <?php 
                    $no = 1;
                        foreach ($books as $book): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $book['judul'] ?></td>
                            <td><?= $book['penulis'] ?></td>
                            <td><?= $book['deskripsi'] ?></td>
                            <td><?= $book['jenis_genre'] ?></td>
                            <td><?= $book['penerbit'] ?></td>
                            <td><?= $book['status'] ?></td>
                            <td>
                                <a href="peminjaman.php?ib=<?= $book['id_buku'] ?>" class="btn btn-primary m-1">Pinjam</a>
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