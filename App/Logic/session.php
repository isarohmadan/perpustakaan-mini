<?php
// Check if user is logged in
function isUserLoggedIn() {
    if (isset($_SESSION['user_id'])) {
        return true;
    }
    return false;
}

// Check if user is an admin
function isUserAdmin($conn) {
    if (isUserLoggedIn()) {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE id_user='$user_id'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($user['level'] == 'Admin') {
                return true;
            }
        }else{
            return false;
        }
    }
    return false;
}
function isUser($conn) {
    if (isUserLoggedIn()) {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE id_user='$user_id'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($user['level'] == 'User') {
                return true;
            }
        }else{
            return false;
        }
    }
    return false;
}

?>