<?php
if (isset($_SESSION['user'])) {
    
    function isAdmin() {
        return ($_SESSION['user']['user_type'] == 'admin') ? 1 : 0 ;
    }

    function isGuest() {
        return ($_SESSION['user']['user_type'] == 'guest') ? 1 : 0 ;
    }

} else {
    $_SESSION['error'] = "Please login to continue";
    header('location: ../index.php');
}