<?php
session_start();
include('includes/dbconnection.php');

// Redirect if user is not logged in
if (empty($_SESSION['aid'])) {
    header('location:logout.php');
    exit;
}

if (isset($_POST['submit'])) {
    $cdata = $_POST['course-short'];
    $coursedata = explode('-', $cdata);

    if (count($coursedata) === 2) {
        $cshortname = $coursedata[0];
        $cfullname = $coursedata[1];

        $sub1 = $_POST['sub1'];
        $sub2 = $_POST['sub2'];
        $sub3 = $_POST['sub3'];
        $sub4 = $_POST['sub4'];

        // Use prepared statements for database insertion
        $stmt = $con->prepare("INSERT INTO subject (cshort, cfull, sub1, sub2, sub3, sub4) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $cshortname, $cfullname, $sub1, $sub2, $sub3, $sub4);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Subject added successfully.";
            $stmt->close();
            header("Location: manage-subjects.php");
            exit;
        } else {
            $error_message = "Something went wrong. Please try again.";
        }
    } else {
        $error_message = "Invalid course data. Please try again.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <form method="post">
        <div id="wrapper">

            <!-- Navigation -->
            <?php include('leftbar.php') ?>;


            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header"> <?php echo strtoupper("welcome" . " " . htmlentities($_SESSION['login'])); ?></h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Add Subject</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-10">

                                        <div class="form-group">
                                            <div class="col-lg-4">
                                                <label>Course Short Name<span id="" style="font-size:11px;color:Red">*</span> </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <select class="form-control" name="course-short" id="cshort" onchange="courseAvailability()" required="required">
                                                    <option VALUE="">SELECT</option>
                                                    <?php $query = mysqli_query($con, "select * from tbl_course");
                                                    while ($res = mysqli_fetch_array($query)) {
                                                    ?>

                                                        <option VALUE="<?php echo htmlentities($res['cid'] . "-" . $res['cfull']); ?>"><?php echo htmlentities($res['cshort']) ?> (<?php echo htmlentities($res['cfull']) ?>)</option>


                                                    <?php } ?>
                                            </div>

                                            </select>
                                            <span id="course-availability-status" style="font-size:12px;"></span>
                                        </div>
                                    </div>

                                    <br><br>


                                    <div class="form-group">
                                        <div class="col-lg-4">
                                            <label>Subject 1</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="sub1" required>
                                        </div>
                                    </div>
                                    <br><br>

                                    <div class="form-group">
                                        <div class="col-lg-4">
                                            <label>Subject 2</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="sub2" required>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="form-group">
                                        <div class="col-lg-4">
                                            <label>Subject 3</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="sub3" required>

                                        </div>
                                    </div>


                                    <br><br>
                                    <div class="form-group">
                                        <div class="col-lg-4">
                                            <label>Subject 4</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="sub4">
                                        </div>
                                    </div>


                                </div>
                                <br><br><br>

                                <div class="form-group">
                                    <div class="col-lg-4">

                                    </div>
                                    <div class="col-lg-6"><br><br>
                                        <input type="submit" class="btn btn-primary" name="submit" value="Add Subject"></button>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        </div>

        </div>


        </div>


        <!-- jQuery -->
        <script src="bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="../bower_components/metisMenu/dist/metisMenu.min.js"
            type="text/javascript"></script>
        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js" type="text/javascript"></script>
        <script>
            function coursefullAvail() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "course_availability.php",
                    data: 'cfull1=' + $("#cfull").val(),
                    type: "POST",
                    success: function(data) {
                        $("#course-status").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }

            function courseAvailability() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "course_availability.php",
                    data: 'cshort1=' + $("#cshort").val(),
                    type: "POST",
                    success: function(data) {
                        $("#course-availability-status").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }
        </script>
</body>

</html>