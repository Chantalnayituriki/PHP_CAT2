<?php
session_start();
include "../includes/functions.php";
include "../includes/config/connection.php";

if (!isset($_SESSION['user'])) {
    header('location:../index.php');
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
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../vendor/css/custom.css"> -->
    <!-- bootsatrap js -->
    <script src="../vendor/js/bootstrap.bundle.js"></script>
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
            <?php if (isAdmin()) : ?>
                <div>
                    <a href="student/create.php" class="btn btn-warning btn-sm px-3">Add Student</a>
                    <a href="member/create.php" class="btn btn-warning btn-sm px-3">Add Group Member</a>
                    <a href="users/manager.php" class="btn btn-warning btn-sm px-3">Manage Users</a>
                </div>
            <?php
         endif; ?>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <!--<li class="breadcrumb-item"><a href="home.php">Home</a></li>!-->
                    <!--<li class="breadcrumb-item active"><a href="home.php">Students</a></li>!-->
                </ol>
            </nav>
        </div>

        <hr>
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
        <div class="row">
            <div class="col-md-4 shadow">
                <h5>All students</h5>

                <?php

                $sql = "SELECT * FROM `student` ORDER BY `id` DESC";
                $result = $conn->query($sql);

                if ($result->rowCount() == 0) : ?>

                    <div class="mt-3">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Ooops!</strong> No registered student here!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>

                    <?php
                else :

                    $data = $result->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($data as $student) : ?>

                        <div class="my-2 ">

                            <div class="border-bottom p-2 d-flex justify-content-between">
                                <?php print $student['fname'] . " " . $student['lname']; ?>

                                <div>
                                    <a href="student/view.php?student=<?php print $student['id']; ?>" class="btn btn-sm btn-success">View</a>
                                    <?php if (isAdmin()) : ?>
                                        <a href="student/edit.php?student=<?php print $student['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                                        <a href="student/destroy.php?student=<?php print $student['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                <?php
                    endforeach;

                endif;
                ?>
            </div>
            <!-- group members -->
            <div class="col-md-8 border-start">
                <h5>Group members</h5>
                <table class="table table-striped shadow">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Class</th>
                            <th>Reg Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //retrieve creator id
                        $creator = $user['created_by'];
                        $i = 1;
                        $chief_id = $user['id'];
                        $sql = "SELECT * FROM `group_members` WHERE `user_id` = '$creator' OR `user_id` = '$chief_id' ORDER BY `id` DESC";
                        $data = $conn->query($sql);
                        if ($data->rowCount() > 0) {
                            while ($member = $data->fetch(pdo::FETCH_ASSOC)) : ?>

                                <tr>
                                    <td><?php print $i;
                                        $i++; ?></td>
                                    <td><?php print $member['fname']; ?></td>
                                    <td><?php print $member['lname']; ?></td>
                                    <td><?php print $member['class']; ?></td>
                                    <td><?php print $member['regno']; ?></td>
                                    <td>
                                        <?php if (isAdmin()) : ?>
                                            <a href="member/destroy.php?member=<?php print $member['id']; ?>" class="btn btn-sm btn-danger">Remove member</a>
                                        <?php
                                    else:
                                        print "NOT ALLOWED";
                                    endif; ?>
                                    </td>
                                </tr>
                            <?php
                            endwhile;
                        } else { ?>
                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>Ooops</strong> No group member available for with this group admin!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </td>
                            </tr>
                        <?php }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>

</body>

</html>