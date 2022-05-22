<?php
include "../../includes/config/connection.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // receive data
    $id = $_POST['id'];
    $user_fn = $_POST['fn'];
    $user_ln = $_POST['ln'];
    $user_email = $_POST['email'];
    $user_vc = $_POST['vc'];
    $user_tel = $_POST['tel'];
    $user_gen = $_POST['gen'];
    $user_regno = $_POST['regno'];

    $sql = "UPDATE `student` SET `fname`='$user_fn',`lname`='$user_ln',`email`='$user_email',`vacc_code`='$user_vc',`phone`='$user_tel',`gender`='$user_gen' WHERE `id` = '$id'";

    $stmt = $conn->prepare($sql);
    if($stmt->execute()){
        // update members
        $conn->exec("UPDATE `group_members` SET `fname`='$user_fn',`lname`='$user_ln',`regno`='$user_regno' WHERE `student_id` = '$id'");

        $_SESSION['success'] = "Student Updated successfully!";
        header('location:../home.php');
    } else {
        $_SESSION['error'] = "Failed to update a student";
        header('location:../home.php');
    }
}