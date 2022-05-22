<?php
include "../../includes/config/connection.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // receive data

    // var_dump($_POST);
    // return;

    $stud_id = $_POST['student_id'];
    $chief = $_POST['user_id'];

    // select student from db
    $result = $conn->query("SELECT * FROM `student` WHERE `id` = '$stud_id'");
    $student = $result->fetch(PDO::FETCH_ASSOC);

    
    
    // store member data in variables
    $member_fn = $student['fname'];
    $member_ln = $student['lname'];
    $member_regno = $student['regno'];
    $member_username = $_POST['member_login_name'];
    $member_pass = $_POST['member_password'];
    $member_pass_comf = $_POST['member_password_comfirm'];
    
    // verify if password matched
    if($member_pass_comf != $member_pass) {
        $_SESSION['error'] = "Password and comfirm password does't match";
        return header('location:create.php');
    }

    // insert data into users table
    $password = password_hash($member_pass,PASSWORD_DEFAULT);
    $sql = "INSERT INTO `users`(`username`, `password`, `firstname`, `lastname`, `user_type`,`created_by`) VALUES ('$member_username','$password','$member_fn','$member_ln','guest','$chief')";
    $conn->exec($sql);
    
    // verify if group member never exist
    $result = $conn->query("SELECT * FROM `group_members` WHERE `student_id` = '$stud_id' AND `user_id` = $chief");
    if($result->rowCount() > 0 ){
        $_SESSION['error'] = "Group member already exist";
        return header('location:../home.php');
    }

    $sql = "INSERT INTO `group_members` (`student_id`,`fname`, `lname`, `regno`,`user_id`) 
    VALUES ('$stud_id','$member_fn', '$member_ln', '$member_regno','$chief')";

    $stmt = $conn->prepare($sql);
    if($stmt->execute()){
        $_SESSION['success'] = "New Member registered successfully!";
        header('location:../home.php');
    } else {
        $_SESSION['error'] = "Failed to create a new member";
        header('location:../home.php');
    }
}