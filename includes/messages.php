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