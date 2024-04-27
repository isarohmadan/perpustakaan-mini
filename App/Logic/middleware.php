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


function validateFileType($file){
    // Validate file type
    $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if ($fileType !== 'pdf') {
      return false;
    }
    return true;
}

function validateSizeFile($file){
    // Validate file size (optional)
    $maxFileSize = 10 * 1024 * 1024; // 10 MB
    if ($file > $maxFileSize) {
      return false;
    }
    return true;
}

function fileValidator($file , $uploaded_path){
    
    if(validateFileType($uploaded_path) == false){
        return false;
    }
    // Validate file size (optional)
    if(validateSizeFile($file['size']) == false){
        return false;
    }
    return true;
}

function generateHashedFileName($originalFileName) {
    $salt = 'your-salt-here';
    $hash = hash_hmac('sha256', $originalFileName, $salt);
    $hashedFileName = substr($hash, 0, 10) . '_' . basename($originalFileName);
    return $hashedFileName;
  }
  