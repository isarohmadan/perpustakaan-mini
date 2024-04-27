<?php
session_start();
require_once'../db/conn.php';
require_once'../App/loader.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    submittedLoginForm($conn, $email, $password);
}
if(isset($_SESSION['user_id'])){
        var_dump($_SESSION['user_id']);
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
}



function submittedLoginForm($conn , $email, $password){
    $email = htmlspecialchars($email);
    $password = md5(htmlspecialchars($password));
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
        echo '
        <script>
            alert("Email atau password salah");
            window.location.href = "login.php";
        </script>
        ';
    
    }

}

// show the login form

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <form action="login.php" method="post" class=" ">
    <section class="">
        <div class="container-fluid d-block ">
            <div class="row d-flex d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                    <div class="mb-md-5 mt-md-4 pb-5">

                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                    <p class="text-white-50 mb-5">Please enter your login and password!</p>

                    <div data-mdb-input-init class="form-outline form-white mb-4">
                        <input type="email" id="email" name="email" class="form-control form-control-lg" />
                        <label class="form-label" for="email">Email</label>
                    </div>

                    <div data-mdb-input-init class="form-outline form-white mb-4">
                        <input type="password" id="password" name="password" class="form-control form-control-lg" />
                        <label class="form-label" for="password">Password</label>
                    </div>

                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                    </div>

                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
    </form>
    
</body>
</html>