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
                        <a href="../../auth/logout.php" class="btn btn-primary">Sign out</a><br><br>
                        <li class="breadcrumb-item"><a href="/group_one/dashboard/home.php">Home</a></li>
                    </div>
                </ul>

            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h1>User management</h1>
            
           
            
        </div>

        <!-- display all users -->
        <?php
        include "../../includes/messages.php";
        $sql = "SELECT * FROM `users`";
        $stmt = $conn->prepare($sql);
        $data = $stmt->execute();
        if ($stmt->rowCount() == 0) : ?>

            <div class="alert alert-info" role="alert">
                No user available right now!
            </div>

        <?php
        else :
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        ?>
            <table class="table table-striped mt-2 border">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Type</th>
                        <th>Date Created</th>
                        <th>Change user</th>
                    </tr>
                </thead>
                <?php
                $i = 0;
                foreach ($data as $user) :
                    ++$i;
                ?>
                    <tr>
                        <td><?php print $i ?></td>
                        <td><?php print $user->firstname ?></td>
                        <td><?php print $user->lastname ?></td>
                        <td><?php print $user->username ?></td>
                        <td><span class="badge  <?php print ($user->user_type == 'admin') ? 'bg-success' : 'bg-danger'; ?>"><?php print $user->user_type ?></span></td>
                        <td><?php print $user->created_at ?></td>
                        <td>
                            <a class="btn <?php print ($user->user_type == 'admin') ? 'btn-success' : 'btn-danger'; ?> btn-sm" href="change_user_type.php?user=<?php print $user->id; ?>">
                                <?php
                                print ($user->user_type == 'admin') ? 'Make Guest' : 'Make Admin';
                                ?>
                            </a>
                            <a href="delete.php?id=<?php print $user->id?>" class="btn btn-secondary btn-sm">Remove</a>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </table>
        <?php
        endif;
        ?>
    </div>

</body>

</html>