<?php
    require('../../db/conn.php');
    require('../../App/loader.php');
    if(isset($_GET['ig'])){
        $id_genre = $_GET['ig'];
        $user = getGenreData($conn,$id_genre);
        if($user == null){
            // redirect ke halaman users    
            header('Location: genre.php');
            die;
        }
        }
    $delete_query = deleteGenreData($conn,$_GET['ig']);
    if($delete_query == true){
        echo("<script>Data berhasil di hapus</script>");
        header('Location: genre.php');
    }else{
        echo("<script>Error! Gagal di hapus</script>");
        header('Location: genre.php');
    }
?> 