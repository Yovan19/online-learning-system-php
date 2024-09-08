<?php
session_start();
require_once '../config.php';
require_once '../admin/includes/auth_validate.php';

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

// Get DB instance. function is defined in config.php
$db = getDbInstance();

// Get Dashboard information
$numUsers = $db->getValue("users", "count(*)");
$numCourses = $db->getValue("courses", "count(*)");

// Define the base path of your admin directory
$adminBase = __DIR__; // Current directory, which is the 'admin' directory

// Include header
include_once $adminBase . '/includes/header.php';
?>

<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content tab-content-basic">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="statistics-details d-flex align-items-center">
                                <div class="col-3">
                                    <p class="statistics-title">Number Of Users</p>
                                    <h3 class="rate-percentage"><?php echo $numUsers; ?></h3>
                                </div>
                                <div class="col-3">
                                    <p class="statistics-title">Number Of Course</p>
                                    <h3 class="rate-percentage"><?php echo $numCourses; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 d-flex flex-column">
                            <div class="row flex-grow">
                                <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                                    <div class="card card-rounded">
                                        <div class="card-body card-rounded">
                                            <h4 class="card-title  card-title-dash">Recent Register Users</h4>
                                            <div class="list align-items-center border-bottom py-2">
                                                <div class="wrapper w-100">
                                                    <p class="mb-2 fw-medium"> Yovan Patel </p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <i class="mdi mdi-calendar text-muted me-1"></i>
                                                            <p class="mb-0 text-small text-muted">Mar 12, 2019</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list align-items-center border-bottom py-2">
                                                <div class="wrapper w-100">
                                                    <p class="mb-2 fw-medium"> Yovan Patel </p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <i class="mdi mdi-calendar text-muted me-1"></i>
                                                            <p class="mb-0 text-small text-muted">Mar 12, 2019</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list align-items-center border-bottom py-2">
                                                <div class="wrapper w-100">
                                                    <p class="mb-2 fw-medium"> Yovan Patel </p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <i class="mdi mdi-calendar text-muted me-1"></i>
                                                            <p class="mb-0 text-small text-muted">Mar 12, 2019</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list align-items-center pt-3">
                                                <div class="wrapper w-100">
                                                    <p class="mb-0">
                                                        <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                                    <div class="card card-rounded">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <h4 class="card-title card-title-dash">Users Activities</h4>
                                            </div>
                                            <ul class="bullet-line-list">
                                                <li>
                                                    <div class="d-flex justify-content-between">
                                                        <div><span class="text-light-green">Yocan Patel</span> learn a PHP course</div>
                                                        <p>Just now</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between">
                                                        <div><span class="text-light-green">Yocan Patel</span> learn a PHP course</div>
                                                        <p>Just now</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between">
                                                        <div><span class="text-light-green">Yocan Patel</span> learn a PHP course</div>
                                                        <p>Just now</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between">
                                                        <div><span class="text-light-green">Yocan Patel</span> learn a PHP course</div>
                                                        <p>Just now</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between">
                                                        <div><span class="text-light-green">Yocan Patel</span> learn a PHP course</div>
                                                        <p>Just now</p>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="list align-items-center pt-3">
                                                <div class="wrapper w-100">
                                                    <p class="mb-0">
                                                        <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 d-flex flex-column">
                            <div class="row flex-grow">
                                <div class="col-12 grid-margin stretch-card">
                                    <div class="card card-rounded">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div>
                                                            <h4 class="card-title card-title-dash">Top Learn Courses</h4>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                            <div class="d-flex">
                                                                <img class="img-sm rounded-10" src="../public/backend/images/faces/face1.jpg" alt="profile">
                                                                <div class="wrapper ms-3">
                                                                    <p class="ms-1 mb-1 fw-bold">PHP Framework</p>
                                                                    <small class="text-muted mb-0">162543</small>
                                                                </div>
                                                            </div>
                                                            <div class="text-muted text-small"> 1h ago </div>
                                                        </div>

                                                        <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                            <div class="d-flex">
                                                                <img class="img-sm rounded-10" src="../public/backend/images/faces/face1.jpg" alt="profile">
                                                                <div class="wrapper ms-3">
                                                                    <p class="ms-1 mb-1 fw-bold">PHP Framework</p>
                                                                    <small class="text-muted mb-0">162543</small>
                                                                </div>
                                                            </div>
                                                            <div class="text-muted text-small"> 1h ago </div>
                                                        </div>

                                                        <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                            <div class="d-flex">
                                                                <img class="img-sm rounded-10" src="../public/backend/images/faces/face1.jpg" alt="profile">
                                                                <div class="wrapper ms-3">
                                                                    <p class="ms-1 mb-1 fw-bold">PHP Framework</p>
                                                                    <small class="text-muted mb-0">162543</small>
                                                                </div>
                                                            </div>
                                                            <div class="text-muted text-small"> 1h ago </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once $adminBase . '/includes/footer.php'; ?>