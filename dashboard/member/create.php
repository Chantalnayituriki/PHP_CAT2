<?php
session_start();
include "../../includes/functions.php";
include "../../includes/config/connection.php";

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
    <link rel="stylesheet" href="../../vendor/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../vendor/css/custom.css"> -->
    <!-- bootsatrap js -->
    <script src="../../vendor/js/bootstrap.bundle.js"></script>
    <title>Group one</title>
</head>

<body style="background-color:#eee">

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
                        <a href="../../auth/logout.php" class="btn btn-primary">Sign out</a>
                    </div>
                </ul>

            </div>
        </div>
    </nav>

    <!-- main contents -->

    <div class="container-fluid mt-2">
        <!-- check if user is allowed to create new student -->
        <div class="d-flex justify-content-between">
            <h4>Create a Group Member</h4>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/group_one/dashboard/home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/group_one/dashboard/student/create.php">Create a student</a></li>
                </ol>
            </nav>
        </div>


        <!-- create new member form -->

        <form action="insert.php" method="post" class="d-flex justify-content-center">
            <div class="row row-cols-md-1 g-2 bg-white rounded p-3 shadow" style="width: 40%;">
                <!-- add user id -->
                <input type="hidden" name="user_id" value="<?php print $user['id']; ?>">
                
                <!-- select a group membber into student table -->
                <div class="col">
                    <div class="pb-2">
                        <?php include "../../includes/messages.php"; ?>
                    </div>
                    <label for="" class="form-label">Select a member</label>
                    <select name="student_id" class="form-control">
                    <?php
                    $data = $conn->query("SELECT * FROM `student`");
                    // loop through students
                    while($student = $data->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php print $student['id'];?>"><?php print $student['fname']." ".$student['lname'];?></option>

                   <?php endwhile; ?>
                   </select>
                </div>

                <div class="col">
                    <label for="">User name</label>
                    <input type="text" name="member_login_name" id="" class="form-control">
                </div>

                <div class="col">
                    <label for="">Password</label>
                    <input type="text" name="member_password" id="" class="form-control">
                </div>

                <div class="col">
                    <label for="">Comfirm Password</label>
                    <input type="text" name="member_password_comfirm" id="" class="form-control">
                </div>

                
                <div class="col d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Add Member</button>
                </div>
            </div>
        </form>


    </div>

</body>

</html>