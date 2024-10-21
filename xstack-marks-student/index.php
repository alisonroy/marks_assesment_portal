<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Title | xStack</title>

    <?php
        // Include this when running locally
        include "local-css.php";
        // Include this when deploying to Azure
        // include "production-css.php";
    ?>

</head>

<body>

    <div id="wrapper">
        <div class="container-scroller">
            <!-- topnav -->
            <?php
                include "topnav.php";
            ?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- right sidebar -->
                <?php
                    // Comment this when running on localhost and uncomment during deployment
                    // include "../xstack-core/right-sidebar.php";
                ?>
                <!-- left-sidebar -->
                <?php
                    include "left-sidebar.php";
                ?>

                <!-- main content -->
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <!--  style="min-height: 100vh;" -->
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                                <div class="d-flex justify-content-between flex-wrap">
                                    <div class="d-flex align-items-center dashboard-header flex-wrap mb-3 mb-sm-0">
                                        <h5 class="mr-4 mb-0 font-weight-bold">Dashboard</h5>
                                        <div class="d-flex align-items-baseline dashboard-breadcrumb">
                                            <p class="text-muted mb-0 mr-1 hover-cursor">App</p>
                                            <i class="mdi mdi-chevron-right mr-1 text-muted"></i>
                                            <p class="text-muted mb-0 mr-1 hover-cursor">xStack</p>
                                            <i class="mdi mdi-chevron-right mr-1 text-muted"></i>
                                            <p class="text-muted mb-0 hover-cursor">Home</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- put your main page content here
                        =======================================
                        end of main content -->
                    </div>
                    <!-- content-wrapper ends -->
                    <?php
                        // Comment this when running on localhost and uncomment during deployment
                        include "../xstack-core/footer.php";
                    ?>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->

            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
    </div>

    <?php
        // Include this when running locally
        include "local-js.php";
        // Include this when running deploying to Azure
        // include "production-js.php";
    ?>

    <script src="js/sample.js"></script>
</body>
</html>