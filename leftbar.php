<nav class="navbar navbar-default navbar-static-top" role="navigation"
    style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span> <span
                class="icon-bar"></span> <span class="icon-bar"></span> <span
                class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="dashboard.php">Student Data Management System</a>
    </div>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <li>
                    <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-file fa-fw"></i> Course<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="add-course.php">Add Course</a>
                        </li>
                        <li>
                            <a href="manage-courses.php">View</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-files-o fa-fw"></i>Subject<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="add-subject.php">Add Subject</a>
                        </li>
                        <li>
                            <a href="manage-subjects.php">View</a>
                        </li>
                    </ul>

                </li>
                <li>
                    <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                </li>
            </ul>
        </div>

    </div>

</nav>