<?php
    require('../../db/conn.php');
    require('../../App/loader.php');
    if(isset($_GET['ib'])){
        $id_genre = $_GET['ib'];
        $book = getBooksData($conn,$id_genre);
        if($book == null){
            // redirect ke halaman books    
            header('Location: buku.php');
            die;
        }
        }
    $delete_query = deleteBooksData($conn,$_GET['ib']);
    if($delete_query == true){
        echo("<script>Data berhasil di hapus</script>");
        header('Location: buku.php');
    }else{
        echo("<script>Error! Gagal di hapus</script>");
        header('Location: buku.php');
    }
?> 