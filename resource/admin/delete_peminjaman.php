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
    if(isset($_GET['ip'])){
        $id_genre = $_GET['ip'];
        $user = getPeminjamanData($conn,$id_genre);
        if($user == null){
            // redirect ke halaman users    
            header('Location: peminjaman.php');
            die;
        }
        }
    $delete_query = deletePeminjamanData($conn,$_GET['ip']);
    if($delete_query == true){
        echo("<script>Data berhasil di hapus</script>");
        header('Location: peminjaman.php');
    }else{
        echo("<script>Error! Gagal di hapus</script>");
        header('Location: peminjaman.php');
    }
?> 