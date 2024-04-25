<?php 

function checkIfUserIsDuplicated($conn ,$email,$nomor,$id_user=NULL){
     // mengecek apakah email dan nomor telepon sudah dipakai apa belum
     $sql = "SELECT * FROM `users` WHERE ((`email`='$email' OR `nomor`='$nomor') AND `id_user`!='$id_user')";
     if($id_user == NULL){
         $sql = "SELECT * FROM `users` WHERE `email`='$email' OR `nomor`='$nomor'";
     }
     $result = $conn->query($sql);
     if ($result && $result->num_rows > 0) {
         return false;
     }
     return true;
}

function checkIfGenreIsDuplicated($conn, $genre , $id_genre=NULL){
    $sql = "SELECT * FROM `genre` WHERE `jenis_genre`='$genre'";
    if($id_genre != NULL){
        $sql = "SELECT * FROM `genre` WHERE `jenis_genre`='$genre' AND `id_genre`!='$id_genre'";
    }
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        return false;
    }
    return true;
}

function checkIfJudulIsDuplicated($conn, $judul, $id_buku=NULL){
    $sql = "SELECT * FROM `books` WHERE `judul`='$judul'";
    if($id_buku != NULL){
        $sql = "SELECT * FROM `books` WHERE `judul`='$judul' AND `id_buku`!='$id_buku'";
    }
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        return false;
    }
    return true;
}