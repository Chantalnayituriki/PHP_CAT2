<?php
session_start();
include "../../includes/config/connection.php";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['student'];
    $sql = "DELETE FROM `student` WHERE `id` = '$id'";
    if($conn->exec($sql)) {
        $_SESSION['success'] = "Student removed successfully!";
        header('location:../home.php');
    }
}