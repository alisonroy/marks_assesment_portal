<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Final Upload | xStack</title>

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
                                            <p class="text-muted mb-0 hover-cursor">Final Upload</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container mt-4" id="final-upload-container">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="font-weight-bold">
                                        Final Upload
                                    </h6>
                                    <form id="final-container-form" class="forms-sample mt-3">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="listofsub">
                                                        Subject
                                                    </label>
                                                    <select class="form-control" id="listofsub">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="listofexam">
                                                        Exam
                                                    </label>
                                                    <select class="form-control" id="listofexam">
                                                        <option disabled selected value> Select Exam </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="listofcomp">
                                                        Component
                                                    </label>
                                                    <select class="form-control" id="listofcomp">
                                                        <option disabled selected value> Select Component </option>
                                                        <option value="internal">Internal</option>
                                                        <option value="external">External</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="marks">
                                                        Marks
                                                    </label>
                                                    <input type="number" class="form-control text-capitalize" id="marks" placeholder="Enter Marks" required="">
                                                </div>
                                            </div>
                                            <small id="final-error" class="text-danger mt-2 font-weight-bold">
                                                The exam Criteria has not been created.The same criteria has already been created or the backend may not be responding at the moment . Please try again
                                                later.
                                            </small>
                                        </div>
                                        <div class="form-group mt-4 d-flex justify-content-end">
                                            <div id="final-loader">
                                                <div class="d-flex align-items-end jumping-dots-loader mr-3">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary font-weight-bold" id="final-upload-button">
                                                Edit Marks
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="card d-none mt-2" id="final-card">
                            <div class="card-body">
                                <div class="d-none" id="final-table"></div>

                                <form id="marks-upload-form" class="forms-sample mt-3">
                                    <div class="d-none justify-content-end mr-3" id="operation-marks">
                                        <div class="form-group form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="operation" id="sum" value="option1" checked>
                                            <label class="form-check-label font-weight-bold  mt-n4" for="sum">
                                                Sum
                                            </label>
                                        </div>
                                        <div class="form-group form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="operation" id="average" value="option2">
                                            <label class="form-check-label font-weight-bold  mt-n4" for="average">
                                                Average
                                            </label>
                                        </div>
                                    </div>
                                </form>


                                <div class="d-none justify-content-end mt-3 mr-3" id="final-marks">
                                    <small id="marks-success" class="text-success mt-2 font-weight-bold mr-3">
                                        Marks has been updated
                                    </small>
                                    <small id="marks-failed" class="text-danger mt-2 font-weight-bold mr-3">
                                        Marks has not been updated. Kindly try again
                                    </small>
                                    <small id="marks-error" class="text-danger mt-2 font-weight-bold mr-3">
                                        Selected marks doesnt add upto the given mark.
                                    </small>
                                    <a href="#" class="btn btn-primary font-weight-bold" onclick="(function(){window.location.reload()})()">Reset</a>
                                    <button type="submit" class="btn btn-primary font-weight-bold ml-2" id="final-button">
                                        Upload Marks
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="bar-loader pt-5" id="final-upload-loader">
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
    <script src="js/final-upload.js"></script>
</body>

</html>