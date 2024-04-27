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
$books = count(getBooksData($conn));
$users = count(getUserData($conn));
$pinjaman = count(getPeminjamanData($conn));
$genres = count(getGenreData($conn));




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="row">
        <?php include('partials/sidebar.php');?>
        <div class="container-fluid col-md-9 mt-5">
    <div class="row">
    <div class="col-xl-6 col-lg-6">
            <div class="card mt-3 l-bg-cherry">
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
            <div class="card mt-3 l-bg-blue-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fas fa-hand-holding"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Jumlah Pinjaman</h5>
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
        <div class="col-xl-6 col-lg-6">
            <div class="card mt-3 l-bg-blue-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Jumlah User</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                            <?= $users?>
                            </h2>
                        </div>
                        <div class="col-4 text-right h2">
                            <span><?= $users?> <i class="fa fa-arrow-up"></i></span>
                        </div>
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-green" role="progressbar" data-width="<?= $users?>%" aria-valuenow="<?= $users?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $users?>%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card mt-3 l-bg-blue-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fas fa-arrows-alt"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Jumlah Genre</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                            <?= $genres?>
                            </h2>
                        </div>
                        <div class="col-4 text-right h2">
                            <span><?= $genres?> <i class="fa fa-arrow-up"></i></span>
                        </div>
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-green" role="progressbar" data-width="<?= $genres?>%" aria-valuenow="<?= $genres?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $genres?>%;"></div>
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