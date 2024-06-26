
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

$book = getBooksData($conn, $_GET['ib']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
     <!-- Include Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Include your custom CSS file -->
    <style>
        body{
            overflow-x: hidden;
        }
        .pdf-viewer {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        
        background-color: #f5f5f5;
        }

        .pdf-viewer iframe {
        width: 80%;
        height: 80%;
        min-height: 100vh;

        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="row">
        <?php include('./partials/sidebar.php'); ?>
        <div class="pdf-viewer p-3 d-flex flex-column col-md-9 container-fluid h-100 overflow-y-scrollable">
            <h1 class="text-center text-uppercase font-weight-bold"><?= $book[0]['judul'] ?></h1>
            <hr>
            <iframe src="./../uploads/<?=$book[0]['path_img']?>" frameborder="0" allowfullscreen></iframe>
            <h6>Penulis : <?= $book[0]['penulis'] ?></h6>
            <h6><?= $book[0]['deskripsi'] ?></h6>
            <hr>
            <h6>Penerbit Buku : <?= $book[0]['penerbit'] ?></h6>
            <h6>Genre : <?= $book[0]['jenis_genre'] ?></h6>
            <h6>Ketersediaan Buku : <?= $book[0]['status'] ?></h6>
            <h6>Supplier Buku : <?= $book[0]['supplier'] ?></h6>
        </div>
    </div>
</body>
</html>