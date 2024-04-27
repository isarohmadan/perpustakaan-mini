<?php
require_once __DIR__.('../../../vendor/autoload.php');
use Ramsey\Uuid\Uuid;


function getBooksWithAvailableStatus($conn,$id = null) {
    $sql = "SELECT * FROM `books` INNER JOIN genre ON books.id_genre = genre.id_genre WHERE id_buku='$id' AND status='Available'";
    if ($id == null) {
        $sql = "SELECT * FROM `books` INNER JOIN genre ON books.id_genre = genre.id_genre WHERE status='Available'";
    }
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    return [];
}


function checkIfUserEverBorrowedBook($conn, $id_user , $id_buku){
    $sql = "SELECT * FROM `peminjaman` WHERE `id_user`='$id_user' AND `id_buku`='$id_buku'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        return true;
    }
    return false;
}

function inputDataPeminjaman($conn, $id_user , $id_buku){
    $kode_pinjaman = Uuid::uuid4()->toString();
    $tanggal_pinjaman = date('Y-m-d');
    if(checkIfUserEverBorrowedBook($conn, $id_user , $id_buku)){
        $sql = "UPDATE `peminjaman` SET `kode_pinjaman` = '$kode_pinjaman',`tanggal_pinjaman`='$tanggal_pinjaman' WHERE `id_user`='$id_user' AND `id_buku`='$id_buku'";
        $result = $conn->query($sql);
        return true;
    }
    $sql = "INSERT INTO `peminjaman` (`id_user`, `id_buku`, `kode_pinjaman`, `tanggal_pinjaman`) VALUES ('$id_user', '$id_buku', '$kode_pinjaman', '$tanggal_pinjaman')";
    $result = $conn->query($sql);
    if ($result) {
        return true;
    }
    return false;
}