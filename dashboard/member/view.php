<?php
session_start();
include "../../includes/functions.php";
include "../../includes/config/connection.php";

if (!isset($_SESSION['user'])) {
    header('location:../../index.php');
}
// store all user data to array
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="../../vendor/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../vendor/css/custom.css"> -->
    <!-- bootsatrap js -->
    <script src="../../vendor/js/bootstrap.bundle.js"></script>
    <title>Group one</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ddd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><?php print $user['firstname'] . " " . $user['lastname']; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>

                <ul class="navbar-nav">
                    <div class="nav-item">
                        <a href="../auth/logout.php" class="btn btn-primary">Sign out</a>
                    </div>
                </ul>

            </div>
        </div>
    </nav>

    <!-- main contents -->

    <div class="container-fluid mt-2">
        <!-- check if user is allowed to create new student -->
        <div class="d-flex justify-content-between">
            <h3>View student</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="home.php">View Students</a></li>
                </ol>
            </nav>
        </div>


        <!-- display errors -->
        <?php
        if (isset($_SESSION['error'])) { ?>
            <div class="mt-3">
                <div class="alert alert-danger" role="alert">
                    <?php
                    print $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            </div>
        <?php   } ?>
        <!-- display success -->
        <?php
        if (isset($_SESSION['success'])) { ?>
            <div class="mt-3">
                <div class="alert alert-success" role="alert">
                    <?php
                    print $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            </div>
        <?php   } ?>


        <!-- display all students -->

        <?php

        $id = $_GET['student'];
        $sql = "SELECT * FROM `student` WHERE `id` = '$id'";
        $result = $conn->query($sql);

        $student = $result->fetchAll(PDO::FETCH_ASSOC);
        $student = $student[0];

        ?>


        <div class="card shadow" style="width: 30rem;">
            <div class="card-body">
                <h5 class="card-title"><?php print $student['fname'] . " " . $student['lname']; ?></h5>
                <p class="card-text">
                <table border="0" class="table text-secondary">
                    <tr>
                        <td><b>Email:</b></td>
                        <td><?php print $student['email']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Phone Number:</b></td>
                        <td><?php print $student['phone']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Gender:</b></td>
                        <td><?php print strtoupper($student['gender']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Vaccination code:</b></td>
                        <td><?php print $student['vacc_code']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Date registered:</b></td>
                        <td><?php print $student['created_at']; ?></td>
                    </tr>
                </table>
                </p>
                <div class="d-flex justify-content-end">
                    <a href="../home.php" class="btn btn-primary btn-sm">Go back</a>
                </div>
            </div>
        </div>


    </div>

</body>

</html>