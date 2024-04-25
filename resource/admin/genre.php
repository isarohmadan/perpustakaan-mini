<?php 
require('../../db/conn.php');
require('../../App/loader.php');
$genres = getGenreData($conn);
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
            <div class="button-create btn btn-primary text-white mb-3 mt-3">
                <a href="genre_create.php" class="text-decoration-none text-white">Create Genre</a>
            </div>
            <h2>TABEL GENRE</h2>
            <hr>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Genre</th>
                        <th>Deskripsi</th>            
                        <th>Aksi</th>            
                    </tr>
      </thead>
      <tbody>
      <?php if($genres != NULL): ?>
            <?php foreach ($genres as $genre): ?>
                <tr>
                    <td><?= $genre['jenis_genre'] ?></td>
                    <td><?= $genre['description'] ?></td>
                    <td>
                        <a href="genre_update.php?ig=<?= $genre['id_genre'] ?>" class="btn btn-primary">Edit</a>
                        <a href="genre_delete.php?ig=<?= $genre['id_genre'] ?>" class="btn btn-danger">Delete</a>
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