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
$data_peminjaman = getPeminjamanData($conn)
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./asset/index.css">
</head>
<body>
    <div class="row">
        <?php include('partials/sidebar.php');?>
            <div class="container-fluid col-md-9 table-buku mt-5">
            <h2>TABEL RIWAYAT PEMINJAMAN</h2>
            <hr>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Peminjam</th>
                            <th>email</th>
                            <th>judul</th>
                            <th>deskripsi</th>
                            <th>tanggal pinjam</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php if($data_peminjaman != NULL): ?>
            <?php foreach ($data_peminjaman as $data): ?>
            <tr>
                <td><?= $data['nama_user'] ?></td>
                <td><?= $data['email'] ?></td>
                <td><?= $data['judul'] ?></td>
                <td><?= $data['deskripsi'] ?></td>
                <td><?= $data['tanggal_pinjaman'] ?></td>
                <td>
                    <a href="delete_peminjaman.php?ip=<?= $data['kode_pinjaman'] ?>" class="btn btn-danger m-1">Delete</a>
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