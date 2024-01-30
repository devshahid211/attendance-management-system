<nav id="sidebar" class="active">

    <div class="sidebar-header text-center">
        <img src=" <?php echo $GLOBALS['SITE_URL'] . "assets/img/softheight final logo 001.png"; ?>" alt="logo" class="img-fluid">
        <!-- <h4 class="sidebar-title theme-item">SoftHeight</h4> -->
    </div>

    <ul class="list-unstyled components text-secondary">
        <li><a href="<?php echo $GLOBALS['SITE_URL'] . "index.php"; ?>"><i class="data-feather theme-item" data-feather="home"></i> <span class="theme-item"> Dashboard</span></a></li>


        <li><a href="<?php echo $GLOBALS['SITE_URL'] . "attendance/index.php"; ?>"><i class="data-feather theme-item" data-feather="eye"></i> <span class="theme-item">Attendance</span></a></li>

         <?php
        if ($_SESSION['loginData']['role'] == '1') { ?>
            <li><a href="<?php echo $GLOBALS['SITE_URL'] . "employee/index.php"; ?>"><i class="data-feather theme-item" data-feather="users"></i> <span class="theme-item">Employee</span></a></li>

            <li><a href="<?php echo $GLOBALS['SITE_URL'] . "salary/index.php"; ?>"><i class="data-feather theme-item" data-feather="dollar-sign"></i> <span class="theme-item">Salary</span></a></li>

            <li><a href="<?php echo $GLOBALS['SITE_URL'] . "form.php";
                            ?>"><i class="data-feather theme-item" data-feather="bell"></i> <span class="theme-item">Notifcation</span></a></li>

        <?php } ?>


        <!-- <li><a href="<?php //echo $GLOBALS['SITE_URL'] . "employee/index.php"; 
                            ?>"><i class="data-feather theme-item" data-feather="users"></i> <span class="theme-item">Employee</span></a></li>-->

        <!-- <li><a href="<?php //echo $GLOBALS['SITE_URL'] . "login.php"; 
                            ?>"><i class="data-feather theme-item" data-feather="log-in"></i> <span class="theme-item">Login</span></a></li>

        <li><a href="<?php //echo $GLOBALS['SITE_URL'] . "register.php"; 
                        ?>"><i class="data-feather theme-item" data-feather="align-center"></i> <span class="theme-item">Register</span></a></li> -->



        <!--         
        <li><a href="<?php //echo $GLOBALS['SITE_URL']."Attendance.php"; 
                        ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
</svg></i> <span class="theme-item">Attendance</span></a></li>

         <li><a href="<?php //echo $GLOBALS['SITE_URL']."form.php"; 
                        ?>"><i class="data-feather theme-item" data-feather="file-text"></i> <span class="theme-item">Forms</span></a></li> -->

        <!-- <li><a href="charts.html"><i class="data-feather theme-item" data-feather="pie-chart"></i> <span class="theme-item"> Charts</span></a></li>
        <li><a href="components.html"><i class="data-feather theme-item" data-feather="grid"></i> <span class="theme-item"> Components</span></a></li>
        <li><a href="extras.html"><i class="data-feather theme-item" data-feather="globe"></i> <span class="theme-item"> Extras</span></a></li>
        <li><a href="loginregister.html"><i class="data-feather theme-item" data-feather="users"></i> <span class="data-feather theme-item"> Login</span></a></li>
        <li><a href="profile.html"><i class="data-feather theme-item" data-feather="user"></i> <span class="theme-item"> Profile</span></a></li>
        <li><a href="preferences.html"><i class="data-feather theme-item" data-feather="gift"></i> <span class="theme-item"> Preferences</span></a></li>
        <li><a href="animation.html"><i class="data-feather theme-item" data-feather="loader"></i> <span class="theme-item"> Animation</span></a></li>
        <li><a href="carousel.html"><i class="data-feather theme-item" data-feather="play"></i> <span class="theme-item"> Carousel</span></a></li>
        <li><a href="blank.html"><i class="data-feather theme-item" data-feather="file"></i> <span class="data-feather theme-item"> Blank</span></a></li>
        <li>
            <div class="sidebardropdown">
                <a href="javascript:void(0);" class="sidebar-dropdown-btn" id="dropdown-btn" onclick="myFunction()"><i class="data-feather theme-item" data-feather="grid"></i> <span class="theme-item"> Dropdown</span><i class="sidenaviconopen float-end" id="sidenavicon" data-feather="chevron-up"></i></a>

                <div class="dropdown-container">
                    <a href="#" class="text-center"><i class="data-feather theme-item" data-feather="file"></i> <span class="data-feather theme-item"> 404 Error</span></a> <a href="#" class="text-center"><i class="data-feather theme-item" data-feather="file"></i> <span class="data-feather theme-item">
                            403 Error</span></a> <a href="#" class="text-center"><i class="data-feather theme-item" data-feather="file"></i> <span class="data-feather theme-item"> 500 Error</span></a>
                </div>
            </div>
        </li> -->
    </ul>

</nav>