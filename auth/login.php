<?php
require_once'../db/conn.php';
require_once'../App/loader.php';

// check if user is logged in
if (isUserAdmin($conn)) {
    // User is not admin, redirect or handle accordingly
    // Example: Redirect to unauthorized page
    header('Location: ../resource/admin/index.php');
    exit;
}else{
    // User is not admin, redirect or handle accordingly
    // Example: Redirect to unauthorized page
    header('Location: ../resource/user/index.php');
    exit;
}

// check if user submitted the login form
if (isset($_POST['email'], $_POST['password'])) {
    // get the email and password from the form
    $email = htmlspecialchars($_POST['email']);
    $password = md5(htmlspecialchars($_POST['password']));
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    // authenticate the user
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id_user'];
        switch ($user['level']) {
            case 'Admin':
                header('Location: ../resource/admin/index.php');
                break;
            
            default:
                header('Location: ../resource/user/index.php');
                break;
        }
    } else {
        // user is not authenticated
        $error = 'email or password is incorrect';
    }
    
}

// show the login form
include 'login_view.php';

?>