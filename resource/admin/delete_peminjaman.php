<?php
    require('../../db/conn.php');
    require('../../App/loader.php');
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