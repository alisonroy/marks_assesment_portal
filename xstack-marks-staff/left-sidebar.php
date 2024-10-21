<?php
error_reporting(0);
?>

<nav class="sidebar sidebar-offcanvas __web-inspector-hide-shortcut__" id="sidebar">
    <div class="sidebar-profile bg-dark">
        <div class="d-flex align-items-center justify-content-between">
            <div class="profile-desc">
                <p class="name mb-0" id="current-user-full-name-container"></p>
                <p class="designation mb-0" id="current-user-department-container"></p>

                <div id="sidebar-profile-shimmer-container">
                    <div class="shine box"></div>
                    <div class="dark-shimmer-container">
                        <div class="shine line1"></div>
                        <div class="shine line2"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <ul class="nav">
        <?php // navbar shimmer start 
        ?>
        <div id="u_0_v_sidebar" class="">
            <div class="_4-u2 mbm _2iwp _4-u8">
                <div class="_2iwo" data-testid="fbfeed_placeholder_story">
                    <div class="_2iwq">
                        <div class="_2iwr"></div>
                        <div class="_2iws"></div>
                        <div class="_2iwt"></div>
                        <div class="_2iwu"></div>
                        <div class="_2iwv"></div>
                        <div class="_2iww"></div>
                        <div class="_2iwx"></div>
                        <div class="_2iwy"></div>
                        <div class="_2iwz"></div>
                        <div class="_2iw-"></div>
                        <div class="_2iw_"></div>
                        <div class="_2ix0"></div>
                    </div>
                    <br>
                    <div class="_2iwq">
                        <div class="_2iwr"></div>
                        <div class="_2iws"></div>
                        <div class="_2iwt"></div>
                        <div class="_2iwu"></div>
                        <div class="_2iwv"></div>
                        <div class="_2iww"></div>
                        <div class="_2iwx"></div>
                        <div class="_2iwy"></div>
                        <div class="_2iwz"></div>
                        <div class="_2iw-"></div>
                        <div class="_2iw_"></div>
                        <div class="_2ix0"></div>
                    </div>
                    <br>
                    <div class="_2iwq">
                        <div class="_2iwr"></div>
                        <div class="_2iws"></div>
                        <div class="_2iwt"></div>
                        <div class="_2iwu"></div>
                        <div class="_2iwv"></div>
                        <div class="_2iww"></div>
                        <div class="_2iwx"></div>
                        <div class="_2iwy"></div>
                        <div class="_2iwz"></div>
                        <div class="_2iw-"></div>
                        <div class="_2iw_"></div>
                        <div class="_2ix0"></div>
                    </div>
                    <br>
                    <div class="_2iwq">
                        <div class="_2iwr"></div>
                        <div class="_2iws"></div>
                        <div class="_2iwt"></div>
                        <div class="_2iwu"></div>
                        <div class="_2iwv"></div>
                        <div class="_2iww"></div>
                        <div class="_2iwx"></div>
                        <div class="_2iwy"></div>
                        <div class="_2iwz"></div>
                        <div class="_2iw-"></div>
                        <div class="_2iw_"></div>
                        <div class="_2ix0"></div>
                    </div>
                    <br>
                    <div class="_2iwq">
                        <div class="_2iwr"></div>
                        <div class="_2iws"></div>
                        <div class="_2iwt"></div>
                        <div class="_2iwu"></div>
                        <div class="_2iwv"></div>
                        <div class="_2iww"></div>
                        <div class="_2iwx"></div>
                        <div class="_2iwy"></div>
                        <div class="_2iwz"></div>
                        <div class="_2iw-"></div>
                        <div class="_2iw_"></div>
                        <div class="_2ix0"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php // navbar shimmer end 
        ?>

        <div class="d-none" id="sidebar-links-container">
            <li class="nav-item" id="homeNavLink">
                <a class="nav-link" href="../xstack-core/home.php">
                    <i class="mdi mdi-shield-home-outline menu-icon"></i>
                    <span class="menu-title">Home</span>
                </a>
            </li>

            <?php /* =========================================
            ============= DO NOT REMOVE THIS =================
            ============================================ */ ?>
            <li class="nav-item" id="markshome">
                <a class="nav-link" href="index.php">
                    <i class="mdi mdi-home-plus menu-icon"></i>
                    <span class="menu-title">Marks Portal</span>
                </a>
            </li>
            <li class="nav-item" id="addexam">
                <a class="nav-link" data-toggle="collapse" href="#collapse" aria-expanded="false" aria-controls="collapse">
                    <i class="mdi mdi-expand-all menu-icon"></i>
                    <span class="menu-title"> Add Exam</span>
                </a>
            </li>
            <div class="collapse" id="collapse">
            </div>
            <li class="nav-item" id="final-upload">
                <a class="nav-link" href="final-upload-page.php">
                    <i class="mdi mdi-cloud-upload menu-icon"></i>
                    <span class="menu-title">Final Upload</span>
                </a>
            </li>
            <li class="nav-item mt-2" id="viewshead">
                <a class="nav-link">
                    <span class="menu-title text-uppercase font-weight-bold">REPORTS</span>
                </a>
            </li>
            <div class="d-none" id="class-advisor-views">
                <li class="nav-item">
                    <a class="nav-link" href="advisor-classview-page.php">
                        <i class="mdi mdi-file-excel menu-icon"></i>
                        <span class="menu-title">Class Reports</span>
                    </a>
                </li>
            </div>
            <div class="d-none" id="hod-views">
                <li class="nav-item">
                    <a class="nav-link" href="hod-classview-page.php">
                        <i class="mdi mdi-file-excel menu-icon"></i>
                        <span class="menu-title">Department Reports</span>
                    </a>
                </li>
            </div>
            <div class="d-none" id="mgmt-views">
                <li class="nav-item">
                    <a class="nav-link" href="mgmt-classview-page.php">
                        <i class="mdi mdi-file-excel menu-icon"></i>
                        <span class="menu-title">College Reports</span>
                    </a>
                </li>
            </div>
            <div id="staff-views">
                <li class="nav-item">
                    <a class="nav-link" href="subject-report-page.php">
                        <i class="mdi mdi-file-excel menu-icon"></i>
                        <span class="menu-title">Subject Reports</span>
                    </a>
                </li>
            </div>
            <li class="nav-item mt-2" id="theorysubhead">
                <a class="nav-link">
                    <span class="menu-title text-uppercase font-weight-bold">Theory Subjects</span>
                </a>
            </li>

            <div id="theorysub"></div>
            <li class="nav-item mt-2 d-none" id="practicalsubhead">
                <a class="nav-link">
                    <span class="menu-title text-uppercase font-weight-bold">Practical Subjects</span>
                </a>
            </li>
            <div id="practicalsub"></div>

            <li class="nav-item mt-2">
                <a class="nav-link">
                    <span class="menu-title text-uppercase font-weight-bold">Utilities</span>
                </a>
            </li>

            <?php // DO NOT MODIFY 
            ?>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="logout()">
                    <i class="mdi mdi-logout menu-icon"></i>
                    <span class="menu-title">Logout</span>
                </a>
            </li>
        </div>
    </ul>
</nav>