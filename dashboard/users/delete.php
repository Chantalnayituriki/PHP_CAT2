<?php
session_start();
$id = $_GET['id'];
include "../../includes/config/connection.php";
$sql = "DELETE FROM `users` WHERE `id` = '$id'";
$stmt = $conn->prepare($sql);
if ($stmt->execute()) :
    $_SESSION['success'] = "User removed successfully";
    header('location:manager.php');
endif;
