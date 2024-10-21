<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Exam | xStack</title>

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
                                            <p class="text-muted mb-0 hover-cursor">Add Exam</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container mt-4" id="add-exam-container">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="font-weight-bold">
                                        Add Exam
                                    </h6>
                                    <form id="addexam" class="forms-sample mt-3">
                                        <div class="row">
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="exam_name">
                                                        Exam
                                                    </label>
                                                    <input type="text" class="form-control text-capitalize" id="exam_name" placeholder="Exam Name" required="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="criteria">
                                                        Criteria
                                                    </label>
                                                    <input type="text" class="form-control text-capitalize" id="criteria" placeholder="Criteria" required="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="total_marks">
                                                        Total Marks
                                                    </label>
                                                    <input type="text" class="form-control text-capitalize" id="total_marks" placeholder="Total Marks" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <small id="adderror" class="text-danger mt-2 font-weight-bold">
                                            The exam criteria has not been created.The same criteria has already been created or the backend may not be responding at the moment . Please try again
                                            later.
                                        </small>
                                        <small id="addsuccess" class="text-success mt-2 font-weight-bold">
                                            The exam criteria has been created
                                        </small>
                                        <div class="form-group mt-4 d-flex justify-content-end">
                                            <div id="addloader">
                                                <div class="d-flex align-items-end jumping-dots-loader mr-3">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </div>
                                            <button type="Reset" class="btn btn-primary font-weight-bold">Reset</button>

                                            <button type="submit" class="btn btn-primary font-weight-bold ml-2" id="sub-add">
                                                Add Exam
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="bar-loader pt-5" id="addexamloader">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <!-- end of main content  -->
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
    <script src="js/addexam.js"> </script>
</body>

</html>