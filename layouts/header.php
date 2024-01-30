<script>
    let BASE_URL = '<?php echo $GLOBALS['SITE_URL']; ?>' || '';
</script>

<nav class="navbar navbar-expand-md navbar-white bg-white py-0" aria-label="navbarexample" id="navbar">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-light py-0">
            <i data-feather="menu"></i> <span></span>
        </button>
        <img src="<?php echo $GLOBALS['SITE_URL'] . "assets/img/softheight final logo 001.png" ?>" alt="logo" class="app-logo theme-item mx-2 navbrandarea1">
        <h4 class="sidebar-title theme-item mt-2 navbrandarea2">SoftHeight</h4>
        <button class="navbar-toggler py-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i data-feather="menu"></i></span>
        </button>

        <div class="collapse navbar-collapse mx-1" id="navbarsExample04">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
<!-- 
                <li class="nav-item">
                    <div class="nav-dropdown">
                        <a class="nav-item nav-link active text-secondary py-0" aria-current="page" href="<?php echo $GLOBALS['SITE_URL'] . "index.php"; ?>"><i class="data-feather theme-item" data-feather="home"></i> <span class="theme-item">Home </span></a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="nav-dropdown"> -->
                        <!-- <a class="nav-item nav-link active text-secondary py-0"
                      	aria-current="page" href="charts.html"> <i -->
                        <!--	class="data-feather theme-item" data-feather="pie-chart"></i> -->
                        <!--	<span class="theme-item">Charts </span></a> -->
                        <!-- 									</div></li> -->
                        <!-- 								<li class="nav-item dropdown nav-dropdown"><a -->
                        <!-- 									class="nav-item nav-link dropdown-toggle text-secondary" -->
                        <!-- 									href="#" id="navbarDropdown" role="button" -->
                        <!-- 									data-bs-toggle="dropdown" aria-expanded="false"> <i -->
                        <!--class="data-feather theme-item" data-feather="mail"></i> <span -->
                        <!--class="theme-item">Dropdown </span> <i -->
                        <!--class="data-feather theme-item" data-feather="chevron-down"></i></a> -->
                        <!-- 									<ul class="dropdown-menu" aria-labelledby="navbarDropdown"> -->
                        <!--<li><a href="#" class="dropdown-item mt-2"><i -->
                        <!--		class="data-feather" data-feather="cloud"></i> Access</a></li> -->
                        <!--<li><a href="#" class="dropdown-item mt-2"><i -->
                        <!--		class="data-feather" data-feather="cloud-lightning"></i> -->
                        <!--		Back ups</a></li> -->
                        <!--<li><a href="#" class="dropdown-item mt-2"><i -->
                        <!--		class="data-feather" data-feather="upload-cloud"></i> -->
                        <!--		Updates</a></li> -->
                        <!-- 									</ul></li> -->
<!-- 
                <li class="nav-item dropdown nav-dropdown"><a class="nav-item nav-link dropdown-toggle text-secondary py-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="data-feather theme-item" data-feather="link"></i> <span class="theme-item">Links</span> <i class="data-feather theme-item" data-feather="chevron-down"></i></a> -->
                    <!-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a href="#" class="dropdown-item mt-2 py-0"><i class="data-feather" data-feather="home"></i> Home 2</a></li>
                        <li><a href="#" class="dropdown-item mt-2 py-0"><i class="data-feather" data-feather="home"></i> Home 3</a></li>
                        <li><a href="#" class="dropdown-item mt-2 py-0"><i class="data-feather" data-feather="home"></i> Home 4</a></li>
                        <li><a href="#" class="dropdown-item mt-2 py-0"><i class="data-feather" data-feather="home"></i> Home 5</a></li>
                        <li><a href="#" class="dropdown-item mt-2 py-0"><i class="data-feather" data-feather="file-text"></i> Forms</a></li>
                        <li><a href="charts.html" class="dropdown-item mt-2 py-0"><i class="data-feather" data-feather="pie-chart"></i> Charts</a></li>
                        <li><a href="#" class="dropdown-item mt-2 py-0"><i class="data-feather" data-feather="grid"></i> Components</a></li>
                        <li><a href="#" class="dropdown-item mt-2 py-0"><i class="data-feather" data-feather="globe"></i> Extras</a></li>
                        <li><a href="#" class="dropdown-item mt-2 py-0"><i class="data-feather" data-feather="log-in"></i> Login</a></li>
                        <li><a href="#" class="dropdown-item mt-2 py-0"><i class="data-feather" data-feather="user"></i> Profile</a></li>
                        <li><a href="#" class="dropdown-item mt-2 py-0"><i class="data-feather" data-feather="gift"></i> Preferences</a></li>
                        <li><a href="#" class="dropdown-item mt-2 py-0"><i class="data-feather" data-feather="loader"></i> Animation</a></li>
                        <li><a href="#" class="dropdown-item mt-2 py-0"><i class="data-feather" data-feather="play"></i> Carousel</a></li>
                        <li><a href="#" class="dropdown-item mt-2 py-0"><i class="data-feather" data-feather="file"></i> Blank</a></li>
                    </ul> -->
                </li>


                <!-- <li class="nav-item dropdown nav-dropdown"><a class="nav-item nav-link dropdown-toggle text-secondary py-0" href="#" id="navbarDropdownMenuLink1" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="data-feather theme-item" data-feather="grid"></i> <span class="theme-item">Services</span><i class="data-feather theme-item" data-feather="chevron-down"></i></a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                        <li><a class="dropdown-item" href="#">Service 1</a></li>
                        <li><a class="dropdown-item" href="#">Service 2</a></li>
                        <li class="dropdown-submenu"><a class="dropdown-item mr-3" href="#">Service Level 1 <i class="data-feather" data-feather="chevron-right"></i></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Submenu 0</a></li>
                                <li><a class="dropdown-item" href="#">Submenu 0</a></li>
                                <li class="dropdown-submenu"><a class="dropdown-item" href="#">Service Level 2<i class="data-feather" data-feather="chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Submenu 1</a></li>
                                        <li><a class="dropdown-item" href="#">Submenu 1</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu"><a class="dropdown-item" href="#">Service Level 2<i class="data-feather" data-feather="chevron-right"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Submenu 2</a></li>
                                        <li><a class="dropdown-item" href="#">Submenu 2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> -->
                <li class="nav-item">
                    <div class="nav-dropdown">
                        <!-- <a class="nav-item nav-link active text-secondary py-0" aria-current="page" href="#" onclick="openOverlayNav()">
                            <i class="data-feather theme-item" data-feather="bookmark"></i>
                            <span class="theme-item">Favorites </span>
                        </a> -->
                    </div>
                </li>
<!-- 
                <li class="nav-item dropdown nav-dropdown"><a class="nav-item nav-link dropdown-toggle text-secondary notification" href="#" id="navbarDropdownmailAlert" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="data-feather theme-item" data-feather="bell"></i>
                        <badge class="badge bg-danger">12</badge>
                    </a>
                    <ul class="dropdown-menu notification-menu" aria-labelledby="navbarDropdownmailAlert">
                        <li class="text-center"><i class="data-feather me-2" data-feather="message-square"></i>Notifications</li>
                        <li><a href="#" class="dropdown-item custom-dropmenu mt-2 text-white bg-info"><i class="data-feather me-2" data-feather="user"></i> Lorem
                                ipsum dolor sit amet</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a href="#" class="dropdown-item custom-dropmenu mt-2 text-white bg-info"><i class="data-feather me-2" data-feather="user"></i> Duis aute
                                irure dolor in reprehenderit</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a href="#" class="dropdown-item custom-dropmenu mt-2 text-white bg-info"><i class="data-feather me-2" data-feather="user"></i> Excepteur
                                sint occaecat cupidatat</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a href="#" class="dropdown-item custom-dropmenu mt-2 text-white bg-info"><i class="data-feather me-2" data-feather="user"></i> Aute
                                irure dolor in reprehenderit in</a></li>
                        <div class="dropdown-divider"></div>
                        <li class="text-center"><a href="#" class="dropdown-item mt-2"><i class="data-feather me-2" data-feather="list"></i> See All Notifications</a></li>
                    </ul>
                </li> -->
<!-- 
                <li class="nav-item dropdown nav-dropdown"><a class="nav-item nav-link dropdown-toggle text-secondary notification" href="#" id="navbarDropdownmail" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="data-feather theme-item" data-feather="mail"></i>
                        <badge class="badge bg-primary">23</badge>
                    </a> -->
                    <ul class="dropdown-menu notification-menu" aria-labelledby="navbarDropdownmail">
                        <li class="text-center"><i class="data-feather me-2" data-feather="mail"></i>Mails</li>
                        <li><a href="#" class="dropdown-item custom-dropmenu mt-2 text-danger"><i class="data-feather me-2" data-feather="mail"></i> Lorem
                                ipsum dolor sit amet</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a href="#" class="dropdown-item custom-dropmenu mt-2 text-danger"><i class="data-feather me-2" data-feather="mail"></i> Duis aute
                                irure dolor in reprehenderit</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a href="#" class="dropdown-item custom-dropmenu mt-2 text-primary"><i class="data-feather me-2" data-feather="mail"></i> Excepteur
                                sint occaecat cupidatat</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a href="#" class="dropdown-item custom-dropmenu mt-2 text-warning"><i class="data-feather me-2" data-feather="mail"></i> Aute
                                irure dolor in reprehenderit in</a></li>
                        <div class="dropdown-divider"></div>
                        <li class="text-center"><a href="#" class="dropdown-item mt-2"><i class="data-feather me-2" data-feather="list"></i> See All Mails</a></li>
                    </ul>
                </li>

            </ul>
            <div class="usermenu">
                <div class="nav-dropdown py-0">
                    <a href="#" class="nav-item nav-link dropdown-toggle text-secondary py-0" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <img class="theme-item user-avatar" src="<?php echo $GLOBALS['SITE_URL'] . "assets/img/earth.svg"; ?>" alt="User image"> <!--<i class="theme-item" -->
                        <!--data-feather="user"></i> --> <span class="theme-item">My
                            Name</span><i class="theme-item" data-feather="chevron-down"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown3">
                        <!-- <li><a href="profile.html" class="dropdown-item mt-2"><i
                                class="data-feather" data-feather="user"></i> Profile</a></li> -->
                        <!-- <li><a href="#" class="dropdown-item mt-2"><i class="data-feather" data-feather="mail"></i> Messages</a></li> -->
                        <li><a href="#" class="dropdown-item mt-2" data-bs-toggle="modal" data-bs-target="#settingsModal"><i class="data-feather" data-feather="settings"></i> Settings</a></li>

                        <form method="post" action="<?php echo $GLOBALS['SITE_URL']."process/auth.php"; ?>">
                            <input type="hidden" name="action" value="logout">
                            <li class="dropdown-item"><i class="data-feather" data-feather="log-out">
                                </i><button class="btn btn-default" type="submit">Logout</button>
                        </form>

                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>


<div class="settings">
    <div class="modal fade" id="settingsModal" aria-labelledby="settingsModalTitle" aria-hidden="true" tabindex="-1">
        <!-- 				 data-bs-backdrop="static" data-bs-keyboard="false" -->
        <div class="modal-dialog modal-dialog-settings">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <section id="logincontent" class="shiftdown">

                        <div class="row g-3 mb-3 mt-3">

                            <div class="col-md-6">
                                <h6 class="text-muted">Select Color</h6>
                                <span onclick="changeColor('0')" class="btn btn-sm btn-primary rounded-circle"><span class="me-2"></span></span> <span onclick="changeColor('1')" class="btn btn-sm btn-success rounded-circle"><span class="me-2"></span></span> <span onclick="changeColor('2')" class="btn btn-sm btn-danger rounded-circle"><span class="me-2"></span></span> <span onclick="changeColor('3')" class="btn btn-sm btn-warning rounded-circle"><span class="me-2"></span></span> <span onclick="changeColor('4')" class="btn btn-sm btn-secondary rounded-circle"><span class="me-2"></span></span>
                                <div class="d-flex justify-content-between">
                                    <button onclick="removeColorCookie()">Reset to
                                        Default</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Preferences</h6>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"> <label class="form-check-label" for="flexSwitchCheckDefault">Switch
                                        option 1</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> <label class="form-check-label" for="flexSwitchCheckChecked">Switch
                                        option 2</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mb-3 mt-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked> <label class="form-check-label" for="defaultCheck1">
                                        Checkbox 1 </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2"> <label class="form-check-label" for="defaultCheck2">
                                        Checkbox 2</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">View Size</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioCompactView"> <label class="form-check-label" for="radioCompactView">
                                        Compact</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioFullView"> <label class="form-check-label" for="radioFullView">
                                        Full-screen </label>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button onclick="removeViewSizeCookie()">Reset to
                                        Default</button>
                                </div>

                            </div>
                        </div>
                        <hr />
                        <button class="btn btn-sm btn-danger" data-bs-dismiss="modal" type="button">
                            <i data-feather="check-circle" class="mr-1"></i> Ok
                        </button>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="sidebarOverlayNav" class="screen-overlay float-end">
    <a href="javascript:void(0)" class="closebtn" onclick="closeOverlayNav()">&times;</a>
    <div class="screen-overlay-content text-secondary">
        <a href="#" class="active">About</a> <a href="#">Services</a> <a href="#">Clients</a> <a href="#">Contact</a>
    </div>
</div>