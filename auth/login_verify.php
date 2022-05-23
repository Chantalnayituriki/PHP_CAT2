<?php
session_start();
include "../includes/config/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // receive form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // validate data
    if(empty($username)){
        $_SESSION['error'] = "Username is required";
        header('location:../index.php');
    }elseif(empty($password)){
        $_SESSION['error'] = "Password is required";
        header('location:../index.php');
    }

    // retrieve data from db
    $result = $conn->query("SELECT * FROM `users` WHERE `username` = '$username' LIMIT 1");
    $data = $result->fetchAll(PDO::FETCH_ASSOC);


    if ($result->rowCount() > 0 ) {
        foreach($data as $user):
            if(password_verify($password,$user['password'])) {
                $_SESSION['user'] = $user;
                header('location:../dashboard/home.php');
            } else {
                $_SESSION['error'] = "Incorrect password";
                header('location:../index.php');
            }
        endforeach;
    } else {
        $_SESSION['error'] = "Invalid Username";
        header('location:../index.php');
    }

}