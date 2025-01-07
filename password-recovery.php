<?php
session_start();
include('includes/dbconnection.php');

// Initialize error message variable
$success_message = '';
$error_message = '';


if (isset($_POST['submit_recovery'])) {
    $uname = $_POST['id'];
    $emailid = $_POST['emailid'];
    $password = $_POST['password'];

    // Secure password hashing
    // $uname = mysqli_real_escape_string($con, $_POST['id']);
    // $emailid = mysqli_real_escape_string($con, $_POST['emailid']);
    // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = mysqli_query($con, "SELECT ID FROM tbl_login WHERE loginid='$uname' AND AdminEmail='$emailid'");
    $ret = mysqli_fetch_array($query);

    if ($ret) {
        mysqli_query($con, "UPDATE tbl_login SET password='$password' WHERE loginid='$uname' AND AdminEmail='$emailid'");
        $success_message = "Password successfully changed.";
    } else {
        $error_message = "Invalid Recovery Details.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Data Management System | Password Recovery</title>
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
</head>

<body-1>
    <div class="container">
        <div class="recovery-container">
            <h2>Student Data Management System</h2>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Password Recovery</h3>
                </div>
                <div class="panel-body">
                    <?php if ($success_message): ?>
                        <div class="alert alert-success"><?php echo $success_message; ?></div>
                    <?php endif; ?>

                    <?php if ($error_message): ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>

                    <form method="post">
                        <div class="form-group">
                            <label for="id">Login ID</label>
                            <input class="form-control" id="id" name="id" type="text" placeholder="Enter Login ID" required>
                        </div>
                        <div class="form-group">
                            <label for="emailid">Admin Email</label>
                            <input class="form-control" id="emailid" name="emailid" type="email" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input class="form-control" id="password" name="password" type="password" placeholder="Enter New Password" required>
                        </div>
                        <button type="submit" name="submit_recovery" class="btn-recovery">Change Password</button>
                    </form>
                </div>
            </div>
            <div class="text-center">
                <a href="login.php">Back to Login</a>
            </div>
        </div>
    </div>

    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <script src="dist/jquery-1.3.2.js" type="text/javascript"></script>
    <script src="dist/jquery.validate.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(function() {
            jQuery("#id").validate({
                expression: "if (VAL.match(/^[a-z]$/)) return true; else return false;",
                message: "Should be a valid id"
            });
            jQuery("#password").validate({
                expression: "if (VAL.match(/^[a-z]$/)) return true; else return false;",
                message: "Should be a valid password"
            });

        });
    </script>
</body-1>

</html>