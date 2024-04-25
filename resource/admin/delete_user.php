<?php
    require('../../db/conn.php');
    require('../../App/loader.php');
    if(isset($_GET['iu'])){
        $id_user = $_GET['iu'];
        $user = getUserDataById($conn,$id_user);
        if($user == null){
            // redirect ke halaman users    
            header('Location: users.php');
            die;
        }
        }
    $delete_query = deleteUserData($conn,$_GET['iu']);
    if($delete_query == true){
        echo("<script>Data berhasil di hapus</script>");
        header('Location: users.php');
    }else{
        echo("<script>Error! Gagal di hapus</script>");
        header('Location: users.php');
    }
?> 