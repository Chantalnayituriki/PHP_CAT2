<?php
session_start();
$id = $_GET['user'];
include "../../includes/config/connection.php";
// get current type of user
$query = $conn->query("SELECT * FROM `users` WHERE `id` = '$id'");
$user = $query->fetch(PDO::FETCH_OBJ);

if (toggleType($conn, $user->user_type, $id)) {
    $real_user_type = ($user->user_type == 'guest') ? 'Admin' : 'Guest';
    $_SESSION['success'] = "User type changed for user : $user->firstname $user->lastname to <b>$real_user_type</b>";
    header('location:manager.php');
} else {
    $_SESSION['error'] = "All user can't be guest!";
    header('location:manager.php');
}


// create a toggle function
function toggleType($connection, string $type, int $id)
{
    if ($type == 'admin') {
        $userType = 'guest';
    } else {
        $userType = 'admin';
    }
    // restrict guest full dorminanation
    if ($userType == 'guest') {
        $query = $connection->query("SELECT id FROM `users` WHERE `user_type` = 'admin'");
        if ($query->rowCount() == 1) {
            return false;
        }
    }
    // update db data
    return $connection->exec("UPDATE `users` SET `user_type`='$userType' WHERE `id` = '$id'");
}
