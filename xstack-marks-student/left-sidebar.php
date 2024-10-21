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
        <!-- <?php // navbar shimmer start ?>
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
        <?php // navbar shimmer end ?> -->

        <div id="sidebar-links-container">

            <?php /* =========================================
            ============= DO NOT REMOVE THIS =================
            ============================================ */ ?>

            <li class="nav-item" id="homeNavLink">
                <a class="nav-link" href="../xstack-core/home.php">
                    <i class="mdi mdi-shield-home-outline menu-icon"></i>
                    <span class="menu-title">Home</span>
                </a>
            </li>

            <?php /* =========================================
            ============= MODIFY CONTENT BELOW ===============
            ============================================ */ ?>

            <li class="nav-item mt-2">
                <a class="nav-link">
                    <span class="menu-title text-uppercase font-weight-bold">Views</span>
                </a>
            </li>
            <li class="nav-item d-none">
                <a class="nav-link" href="subject-report-page.php">
                    <i class="mdi mdi-file-excel menu-icon"></i>
                    <span class="menu-title">Subject Reports</span>
                </a>
            </li>
            <div id="class-advisor-views">
                <li class="nav-item" id="staffWeeklyReportsPage">
                    <a class="nav-link" href="staff-weekly-reports-page.php">
                        <i class="mdi mdi-file-excel menu-icon"></i>
                        <span class="menu-title">Weekly Attendance</span>
                    </a>
                </li>
                <li class="nav-item" id="staffMonthlyReportsPage">
                    <a class="nav-link" href="class-advisor-monthly-reports-page.php">
                        <i class="mdi mdi-file-excel menu-icon"></i>
                        <span class="menu-title">Monthly Attendance</span>
                    </a>
                </li>
                <li class="nav-item" id="staffConsolidatedReportsPage">
                    <a class="nav-link" href="staff-class-reports-page.php">
                        <i class="mdi mdi-file-excel menu-icon"></i>
                        <span class="menu-title">Consolidated Reports</span>
                    </a>
                </li>
            </div>
            <div id="hod-views">
                <li class="nav-item">
                    <a class="nav-link" href="hod-class-reports-page.php">
                        <i class="mdi mdi-file-excel menu-icon"></i>
                        <span class="menu-title">Class Reports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="hod-weekly-reports-page.php">
                        <i class="mdi mdi-file-excel menu-icon"></i>
                        <span class="menu-title">Weekly Reports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="hod-monthly-reports-page.php">
                        <i class="mdi mdi-file-excel menu-icon"></i>
                        <span class="menu-title">Monthly Reports</span>
                    </a>
                </li>
            </div>
            <div id="mgmt-views">
                <li class="nav-item">
                    <a class="nav-link" href="mgmt-class-reports-page.php">
                        <i class="mdi mdi-file-excel menu-icon"></i>
                        <span class="menu-title">Class Reports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mgmt-weekly-reports-page.php">
                        <i class="mdi mdi-file-excel menu-icon"></i>
                        <span class="menu-title">Weekly Reports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mgmt-monthly-reports-page.php">
                        <i class="mdi mdi-file-excel menu-icon"></i>
                        <span class="menu-title">Monthly Reports</span>
                    </a>
                </li>
            </div>
            <div id="admin-views">
                <li class="nav-item mt-2">
                    <a class="nav-link">
                        <span class="menu-title text-uppercase font-weight-bold">Administration</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user-management.php">
                        <i class="mdi mdi-account-group menu-icon"></i>
                        <span class="menu-title">User Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create-class-page.php">
                        <i class="mdi mdi-google-classroom menu-icon"></i>
                        <span class="menu-title">Create Class</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="subjects-page.php">
                        <i class="mdi mdi-book-open menu-icon"></i>
                        <span class="menu-title">Create Subject</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="extras-page.php">
                        <i class="mdi mdi-camera-image menu-icon"></i>
                        <span class="menu-title">Extra Staff</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="permissions-page.php">
                        <i class="mdi mdi-account-clock menu-icon"></i>
                        <span class="menu-title">Substitute Staff</span>
                    </a>
                </li>
            </div>

            <li class="nav-item mt-2">
                <a class="nav-link">
                    <span class="menu-title text-uppercase font-weight-bold">Utilities</span>
                </a>
            </li>
            <li class="nav-item" id="settingsNavLink">
                <a class="nav-link" href="settings.php">
                    <i class="mdi mdi-tooltip-edit menu-icon"></i>
                    <span class="menu-title">Account Settings</span>
                </a>
            </li>
            <li class="nav-item" id="downloadsNavLink">
                <a class="nav-link" href="downloads.php">
                    <i class="mdi mdi-cellphone-android menu-icon"></i>
                    <span class="menu-title">Mobile Apps</span>
                </a>
            </li>
            <li class="nav-item" id="supportNavLink">
                <a class="nav-link" href="support.php">
                    <i class="mdi mdi-human menu-icon"></i>
                    <span class="menu-title">Get Support</span>
                </a>
            </li>
            <li class="nav-item" id="contactNavLink">
                <a class="nav-link" href="contact-page.php">
                    <i class="mdi mdi-phone menu-icon"></i>
                    <span class="menu-title">Contact Us</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://licet-xstack.mixspace.xyz" target="top">
                    <i class="mdi mdi-heart-pulse menu-icon"></i>
                    <span class="menu-title">xStack Status</span>
                </a>
            </li>
            <?php // DO NOT MODIFY ?>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="logout()">
                    <i class="mdi mdi-logout menu-icon"></i>
                    <span class="menu-title">Logout</span>
                </a>
            </li>
        </div>
    </ul>
</nav>