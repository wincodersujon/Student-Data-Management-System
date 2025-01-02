<?php 
session_start();
include('includes/dbconnection.php');

$error_message = ''; // Variable to store the error message

if(isset($_POST['submit'])) {
    $uname = $_POST['id'];
    $Password = $_POST['password'];
    $query = mysqli_query($con, "SELECT ID, loginid FROM tbl_login WHERE loginid='$uname' AND password='$Password'");
    $ret = mysqli_fetch_array($query);
    
    if($ret > 0) {
        $_SESSION['aid'] = $ret['ID'];
        $_SESSION['login'] = $ret['loginid'];
        header('location:dashboard.php');
    } else {
        $error_message = "Invalid Details"; // Set the error message if login fails
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Data Management System | Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../dist/css/jquery.validate.css" />
     <!-- Custom CSS -->
     <link rel="stylesheet" type="text/css" href="dist/css/sb-admin-2.css">
</head>

<body-1>
    <div class="login-container">
        <h2>Student Data Management System</h2>

        <?php
        // If there is an error message, display it
        if (!empty($error_message)) {
            echo '<div class="error-message">' . $error_message . '</div>';
        }
        ?>

        <form method="post">
            <div class="form-group">
                <label for="id">Login Id</label>
                <input class="form-control" id="id" name="id" type="text" placeholder="Enter your login ID" required autofocus autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" id="password" name="password" type="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" name="submit" class="btn-login">Login</button>
        </form>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="dist/jquery-1.3.2.js" type="text/javascript"></script>
    <script src="dist/jquery.validate.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(function(){
            jQuery("#id").validate({
                expression: "if (VAL.match(/^[a-zA-Z0-9]+$/)) return true; else return false;",
                message: "Login ID should be alphanumeric"
            });
            jQuery("#password").validate({
                expression: "if (VAL.match(/^[a-zA-Z0-9]+$/)) return true; else return false;",
                message: "Password should be alphanumeric"
            });
        });
    </script>
</body-1>

</html>
