<?php  session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/css/custom.css">
    <!-- bootsatrap js -->
    <script src="vendor/js/bootstrap.bundle.js"></script>
    <title>Group one</title>
</head>

<body>

    <div class="wrap p-4 shadow">
        <h1 class="text-secondary"><span class="border-bottom border-primary border-4">User</span> Login</h1>

        <!-- display errors -->
        <?php
        if (isset($_SESSION['error'])) : ?>
            <div class="mt-3">
                <div class="alert alert-danger" role="alert">
                    <?php
                        print $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            </div>
        <?php   endif; ?>
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
        <!-- login form -->
        <form class="mt-4" action="auth/login_verify.php" method="post">
            <div class="form-floating mb-3">
                <input name="username" type="text" class="form-control" id="floatingInput" placeholder="enter username">
                <label for="floatingInput"></label>
            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="enter password">
                <label for="floatingPassword"></label>
            </div>

            <div class="d-grid gap-2 mt-3">
                <button class="btn btn-primary" type="submit">Login</button>
            </div>
            
        </form>

    </div>

</body>

</html>