<?php
include "../../includes/config/connection.php";
session_start();

$id = $_GET['member'];

$sql = "SELECT * FROM `group_members` WHERE `id` = '$id'";
$data = $conn->query($sql);
$student = $data->fetch(PDO::FETCH_OBJ);

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
            <a class="navbar-brand" href="#">AKIMANA Gabriel</a>
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
            <h4>Edit member information</h4>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="home.php">Update student</a></li>
                </ol>
            </nav>
        </div>


        <!-- create new students form -->

        <form action="update.php" method="post" class="d-flex justify-content-center">
            <div class="row row-cols-md-1 g-2 bg-white rounded p-3 shadow" style="width: 40%;">

                <input type="hidden" value="<?php print $student->id ?>" name="id">

                <div class="col">
                    <label for="" class="form-label">First Name</label>
                    <input type="text" value="<?php print $student->fname ?>" class="form-control" name="fn">
                </div>

                <div class="col">
                    <label for="" class="form-label">Last Name</label>
                    <input value="<?php print $student->lname ?>" type="text" class="form-control" name="ln">
                </div>

                <div class="col">
                    <label for="" class="form-label">Registration Number</label>
                    <input value="<?php print $student->regno ?>" type="text" class="form-control" name="regno">
                </div>

                <div class="col d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update Member</button>
                </div>
            </div>
        </form>


    </div>

</body>

</html>