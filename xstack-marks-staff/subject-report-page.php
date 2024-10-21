<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Subject Reports | xStack</title>

    <?php
    include "production-css.php";
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
                include "../xstack-core/right-sidebar.php";
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
                                            <p class="text-muted mb-0 hover-cursor">Marks Portal</p>
                                            <i class="mdi mdi-chevron-right mr-1 text-muted"></i>
                                            <p class="text-muted mb-0 hover-cursor">Subject Reports</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container mt-4" id="subreportscontainer">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="font-weight-bold">
                                        View Subjects Reports
                                    </h6>
                                    <form id="sub-report-view" class="forms-sample mt-3">
                                        <div class="row">
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="listofsub">
                                                        Subject
                                                    </label>
                                                    <select class="form-control" id="listofsub">
                                                        <option disabled selected value> Select Subject </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="listofexam">
                                                        Exam
                                                    </label>
                                                    <select class="form-control" id="listofexam">
                                                        <option disabled selected value> Select Exam </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="report-type">
                                                        Report Type
                                                    </label>
                                                    <select class="form-control" id="report-type">
                                                        <option disabled selected value> Select Report Type </option>
                                                        <option value="consolidated"> Consolidated </option>
                                                        <option value="cummulative"> Cummulative </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex justify-content-end mt-4">
                                            <div id="subjectreportsloader">
                                                <div class="d-flex align-items-end jumping-dots-loader mr-3">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary font-weight-bold" id="sub-view">
                                                View Reports
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="d-none" id="view-mark">
                        </div>

                        <iframe frameborder="0" class="excel-view-iframe mt-5 d-none" id="subject-Iframe" scrolling="no" style="display: block;"></iframe>

                        <div class=" comntainer d-none justify-content-end mt-3 mr-3" id="sub-utilities">
                            <a href="#" class="btn btn-primary font-weight-bold" onclick="(function(){window.location.reload()})()">
                                Reset
                            </a>
                            <a href="#" class="btn btn-primary font-weight-bold ml-2" id="sub-report-download">
                                Download
                            </a>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="bar-loader pt-5" id="subjectpageloader">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>

                        <!-- end of main content -->
                    </div>
                    <!-- content-wrapper ends -->
                    <?php
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
    include "production-js.php";
    ?>
    <script src="js/left-sidebar.js"> </script>
    <script src="js/subject-report.js"></script>
</body>

</html>