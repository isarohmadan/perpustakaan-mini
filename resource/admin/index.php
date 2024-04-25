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
    <div class="row">
        <?php include('partials/sidebar.php');?>
        <div class="container-fluid col-md-9 table-buku">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Deskripsi</th>
                        <th>Genre</th>
                        <th>Penerbit</th>
                        <th>Supplier</th>
                    </tr>
      </thead>
      <tbody>
      <?php foreach ($books as $book): ?>
        <tr>
            <td><?= $book['judul'] ?></td>
            <td><?= $book['penulis'] ?></td>
            <td><?= $book['deskripsi'] ?></td>
            <td><?= $book['id_genre'] ?></td>
            <td><?= $book['penerbit'] ?></td>
            <td><?= $book['status'] ?></td>
        </tr>
        <?php endforeach; ?>
        <!-- Add more rows as needed -->
    </tbody>

</table>
</div>

</div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>