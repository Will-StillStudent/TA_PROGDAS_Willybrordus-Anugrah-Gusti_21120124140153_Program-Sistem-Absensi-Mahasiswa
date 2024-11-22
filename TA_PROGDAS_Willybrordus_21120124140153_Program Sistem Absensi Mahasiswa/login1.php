<?php

// Array 
$users = [
    ["username" => "admin", "password" => "admin123"],
    ["username" => "user1", "password" => "password1"],
    ["username" => "user2", "password" => "password2"]
];

//Stack 
$loginHistory = [];



function checkLogin($username, $password, $users) {
    foreach ($users as $user) {
        if ($user['username'] == $username && $user['password'] == $password) {
            return true;
        }
    }
    return false;
}


$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';


if ($username && $password) {
    if (checkLogin($username, $password, $users)) {
       
        session_start();
        $_SESSION['username'] = $username;

        
        header('Location: FormLogin.php');
        exit();

        array_push($loginHistory, "Login Failed: $username");
    } else {
        echo "<script>alert('Login Failed! Invalid username or password.'); window.location.href='index1.php';</script>";
    }
} else {
    echo "<script>alert('Username and Password cannot be empty'); window.location.href='index1.php';</script>";
}
?>
