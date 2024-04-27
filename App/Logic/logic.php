<?php
require_once __DIR__.('../../../vendor/autoload.php');
require_once('middleware.php');
use Ramsey\Uuid\Uuid;


function getUserData($conn){
    $sql = "SELECT * FROM `users`";
    $result = $conn->query($sql);
    $data = array();
    if ($result && $result->num_rows > 0) {
        // Loop through each row and fetch it as an associative array
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    
 return null;
}

function getUserDataById($conn,$id){
    $sql = "SELECT * FROM `users` WHERE id_user='$id'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

function createUserData($conn,$data){
    $nama_user = htmlspecialchars($data['username']);  
    $email = htmlspecialchars($data['email']);
    $alamat = htmlspecialchars($data['alamat']);
    $nomor = htmlspecialchars($data['nomor']);
    $password = htmlspecialchars(md5($data['password']));
    $level = htmlspecialchars($data['level']);
    $uuid =Uuid::uuid4();
    $uuid->toString();
    if(checkIfUserIsDuplicated($conn,$email,$nomor) == false){
        return false;
    };
    $sql = "INSERT INTO `users` (`id_user`, `nama_user`, `email`, `alamat`, `nomor`, `password`, `level`) VALUES ('$uuid', '$nama_user', '$email', '$alamat', '$nomor', '$password', '$level')";
    $result = $conn->query($sql);
    if ($result) {
        return true;
    }
    return false;
}

function updateUserData($conn,$data){
    $id_user = htmlspecialchars($data['id_user']);
    $nama_user = htmlspecialchars($data['username']);  
    $email = htmlspecialchars($data['email']);
    $alamat = htmlspecialchars($data['alamat']);
    $nomor = htmlspecialchars($data['nomor']);
    $password = htmlspecialchars(md5($data['password']));
    $level = htmlspecialchars($data['level']);

    if(checkIfUserIsDuplicated($conn,$email,$nomor,$id_user) == false){
        return false;
    };
   
    $sql = "UPDATE `users` SET `nama_user`='$nama_user', `email`='$email', `alamat`='$alamat', `nomor`='$nomor', `password`='$password', `level`='$level' WHERE `id_user`='$id_user'";
    $result = $conn->query($sql);
    if ($result) {
        return true;
    }
    return false;
}

function deleteUserData($conn,$id){
    $sql = "DELETE FROM `users` WHERE id_user='$id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        return true;
    }
    return false;
}


// BOOKS SECTION


function getBooksData($conn,$id=NULL){
    $sql = "SELECT * FROM `books` INNER JOIN genre ON books.id_genre = genre.id_genre WHERE id_buku='$id'";
    if ($id == NULL) {
        $sql = "SELECT * FROM `books` INNER JOIN genre ON books.id_genre = genre.id_genre;";
    }
    $result = $conn->query($sql);
    $data = array();
    if ($result && $result->num_rows > 0) {
        // Loop through each row and fetch it as an associative array
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    
 return null;
}

function createBooksData($conn , $data, $file){
    $judul = htmlspecialchars($data['judul']);
    $penulis = htmlspecialchars($data['penulis']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $supplier = htmlspecialchars($data['supplier']);
    $id_genre = htmlspecialchars($data['genre']);
    $status = htmlspecialchars($data['status']);
    $deskripsi = htmlspecialchars($data['description']);
    $uploaded_pdf_file = $file['pdf-file'];
    $uuid = Uuid::uuid4();
    $uuid->toString();

    // lokasi penyimpanan file
    $uploadDir = __DIR__.'/../../resource/uploads/';
    $tmp_name_file = generateHashedFileName($uploaded_pdf_file['name']);
    $upload_pdf_file_path = $uploadDir . basename($tmp_name_file);

    if(fileValidator($uploaded_pdf_file , $upload_pdf_file_path) == false){
        echo "<script> alert('Perhatikan File Size dan Formatnya!') 
        window.location.href = 'buku.php';
        </script>";
        return false;
    }
    

    if(checkIfJudulIsDuplicated($conn,$judul) == false){
        return false;
    };
    $sql = "INSERT INTO `books` (`id_buku`, `judul`, `penulis`, `deskripsi`, `penerbit`, `id_genre`, `status`, `supplier`,`path_img`) VALUES ('$uuid', '$judul', '$penulis', '$deskripsi', '$penerbit', '$id_genre', '$status', '$supplier' , '$tmp_name_file')";
    $result = $conn->query($sql);
    // Move uploaded file to target directory
    if (move_uploaded_file($uploaded_pdf_file['tmp_name'], $upload_pdf_file_path)) {
        echo 'File uploaded successfully.';
    } else {
        echo 'Error uploading file.';

        die;
    }
    if ($result) {
        return true;
    }
    return false;
}

function updatebookData($conn , $data){
    $id_buku = htmlspecialchars($data['id_buku']);
    $judul = htmlspecialchars($data['judul']);
    $penulis = htmlspecialchars($data['penulis']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $supplier = htmlspecialchars($data['supplier']);
    $id_genre = htmlspecialchars($data['genre']);
    $status = htmlspecialchars($data['status']);
    $deskripsi = htmlspecialchars($data['description']);
    if(checkIfJudulIsDuplicated($conn,$judul,$id_buku) == false){
        return false;
    };
    $sql = "UPDATE `books` SET `judul`='$judul', `penulis`='$penulis', `deskripsi`='$deskripsi', `penerbit`='$penerbit', `id_genre`='$id_genre', `status`='$status', `supplier`='$supplier' WHERE `id_buku`='$id_buku'";
    $result = $conn->query($sql);
    if ($result) {
        return true;
    }
    return false;
}


function deleteBooksData($conn,$id){
    $sql = "DELETE FROM `books` WHERE id_buku='$id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        return true;
    }
    return false;
}


// PEMINJAMAN SECTION
function getPeminjamanData($conn){
    $sql = "SELECT users.nama_user, users.email, books.judul , books.deskripsi , kode_pinjaman, tanggal_pinjaman
    FROM ((peminjaman INNER JOIN users ON peminjaman.id_user = users.id_user)INNER JOIN books ON peminjaman.id_buku = books.id_buku);";
    $result = $conn->query($sql);
    $data = array();
    if ($result && $result->num_rows > 0) {
        // Loop through each row and fetch it as an associative array
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    
 return null;
}


function deletePeminjamanData($conn , $id){
    $sql = "DELETE FROM `peminjaman` WHERE kode_pinjaman='$id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        return true;
    }
    return false;
}

// Genre

function getGenreData($conn , $id = NULL){
    $sql = "SELECT * FROM `genre` WHERE id_genre='$id'";
    if ($id == NULL) {
        $sql = "SELECT * FROM `genre`";
    }
    $result = $conn->query($sql);
    $data = array();
    if ($result && $result->num_rows > 0) {
        // Loop through each row and fetch it as an associative array
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    
    return null;
}

function createGenreData($conn,$data){
    $genre = htmlspecialchars($data['genre']);
    $description = htmlspecialchars($data['description']);

    if(checkIfGenreIsDuplicated($conn,$genre) == false){
        return false;
    };
    $sql = "INSERT INTO `genre` (`jenis_genre`, `description`) VALUES ('$genre', '$description')";
    $result = $conn->query($sql);
    if ($result) {
        return true;
    }
    return false;
}

function updateGenreData($conn,$data){
    $id_genre = htmlspecialchars($data['id_genre']);
    $genre = htmlspecialchars($data['jenis_genre']);
    $description = htmlspecialchars($data['description']);

    if(checkIfGenreIsDuplicated($conn,$genre) == false){
        return false;
    };
    $sql =  "UPDATE `genre` SET `jenis_genre`='$genre', `description`='$description' WHERE `id_genre`='$id_genre'";
    $result = $conn->query($sql);
    if ($result) {
        return true;
    }
    return false;
}

function deleteGenreData($conn,$id){
    $sql = "DELETE FROM `genre` WHERE id_genre='$id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        return true;
    }
    return false;
}
