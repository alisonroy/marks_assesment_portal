<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Marks | xStack</title>

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
                                            <p class="text-muted mb-0 hover-cursor">Edit Marks</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container mt-4" id="editmarkscontainer">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="font-weight-bold">
                                        Edit Marks
                                    </h6>
                                    <form id="examview" class="forms-sample mt-3">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="listofexams">
                                                        Exam
                                                    </label>
                                                    <select class="form-control" id="listofexams">
                                                        <option disabled selected value> Select Exam </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="listofcri">
                                                        Criteria
                                                    </label>
                                                    <select class="form-control" id="listofcri">
                                                        <option disabled selected value> Select Criteria </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-4 d-flex justify-content-end">
                                            <div id="editloader">
                                                <div class="d-flex align-items-end jumping-dots-loader mr-3">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary font-weight-bold" id="sub-edit">
                                                Edit Marks
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="card d-none mt-2" id="editmark-card">
                            <div class="card-body">
                                <div class="d-none" id="editmark-table"></div>

                                <div class="d-none justify-content-end mt-3 mr-3" id="save-marks">
                                    <small id="editsuccess" class="text-success mt-2 font-weight-bold mr-3">
                                        Marks has been updated
                                    </small>
                                    <small id="editfielderror" class="text-danger mt-2 font-weight-bold mr-3">
                                        Kindly check the above fields
                                    </small>
                                    <small id="editerror" class="text-danger mt-2 font-weight-bold mr-3">
                                        Marks has not been updated. Kindly try again
                                    </small>
                                    <a href="#" class="btn btn-primary font-weight-bold" onclick="(function(){window.location.reload()})()">Reset</a>
                                    <button type="submit" class="btn btn-primary  font-weight-bold ml-2" id="add-marks">
                                        Save Marks
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="bar-loader pt-5" id="editpageloader">
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
    <script src="js/editmarks.js"></script>
    <script src="js/appendmarks.js"></script>
</body>

</html>