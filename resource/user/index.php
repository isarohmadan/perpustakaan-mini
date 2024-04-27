<?php 
session_start();
require('../../db/conn.php');
require('../../App/loader.php');

if(isUserLoggedIn() == false){
    header('Location: ../../auth/login.php');
    exit;
}
if(isUser($conn) == false){
    header('Location: ../user/index.php');
    exit;
}
$books = count(getBooksData($conn));
$pinjaman = count(getPeminjamanData($conn,$_SESSION['user_id']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./asset/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
</head>
<body class="overflow-x-hidden">
    <div class="row">
        <?php include('partials/sidebar.php');?>

    <div class="container-fluid col-md-9 mt-5">
    <div class="row">
    <div class="col-xl-6 col-lg-6">
            <div class="card l-bg-cherry">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fas fa-book"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Jumlah Buku</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                            <?= $books?>
                            </h2>
                        </div>
                        <div class="col-4 text-right h2">
                            <span><?= $books?> <i class="fa fa-arrow-up"></i></span>
                        </div>
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="<?= $books?>%" aria-valuenow="<?= $books?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $books?>%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card l-bg-blue-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Jumlah Buku Yang Anda Pinjam</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                            <?= $pinjaman?>
                            </h2>
                        </div>
                        <div class="col-4 text-right h2">
                            <span><?= $pinjaman?> <i class="fa fa-arrow-up"></i></span>
                        </div>
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-green" role="progressbar" data-width="<?= $pinjaman?>%" aria-valuenow="<?= $pinjaman?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $pinjaman?>%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>    
    </div>

</div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>