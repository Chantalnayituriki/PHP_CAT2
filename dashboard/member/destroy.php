<?php
session_start();
include "../../includes/config/connection.php";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['member'];
    $sql = "DELETE FROM `group_members` WHERE `id` = '$id'";
    if($conn->exec($sql)) {
        $_SESSION['success'] = "Member removed successfully!";
        header('location:../home.php');
    }
}