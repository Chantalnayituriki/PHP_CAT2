<?php
include "../../includes/config/connection.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // receive data
    $user_fn = $_POST['fn'];
    $user_ln = $_POST['ln'];
    $user_email = $_POST['email'];
    $user_vc = $_POST['vc'];
    $user_tel = $_POST['tel'];
    $user_gen = $_POST['gen'];
    $chief_id = $_POST['user_id'];
    $user_regno = $_POST['regno'];



    $sql = "INSERT INTO `student`(`fname`, `lname`, `email`, `vacc_code`, `phone`, `gender`, `user_id`,`regno`) 
    VALUES ('$user_fn','$user_ln','$user_email','$user_vc','$user_tel','$user_gen','$chief_id','$user_regno')";

    $stmt = $conn->prepare($sql);
    if($stmt->execute()){
        $_SESSION['success'] = "New student registered successfully!";
        header('location:../home.php');
    } else {
        $_SESSION['error'] = "Failed to create a new student";
        header('location:../home.php');
    }
}