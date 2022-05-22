<?php
include "../../includes/config/connection.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // receive data
    $id = $_POST['id'];
    $user_fn = $_POST['fn'];
    $user_ln = $_POST['ln'];
    $user_regno = $_POST['regno'];
   
    $sql = "UPDATE `group_members` SET `fname`='$user_fn',`lname`='$user_ln',`regno`='$user_regno' WHERE `id` = '$id'";

    $stmt = $conn->prepare($sql);
    if($stmt->execute()){
        $_SESSION['success'] = "Member Updated successfully!";
        header('location:../home.php');
    } else {
        $_SESSION['error'] = "Failed to update a Member";
        header('location:../home.php');
    }
}