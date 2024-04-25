<?php
session_start();
require('db/conn.php');
require('App/loader.php');
// assuming you have a session_start() at the beginning of your script

if (!isUserLoggedIn()) {
    // User is not logged in, redirect to login page
    header('Location: auth/login.php');
    exit;
}

// Check if user is admin
if (isUserAdmin($conn)) {
    // User is not admin, redirect or handle accordingly
    // Example: Redirect to unauthorized page
    header('Location: resource/admin/index.php');
    exit;
}else{
    // User is not admin, redirect or handle accordingly
    // Example: Redirect to unauthorized page
    header('Location: resource/user/index.php');
    exit;
}


?>