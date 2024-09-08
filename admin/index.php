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
                                    <p class="statistics-title">Number Of Courses</p>
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
                                            <h4 class="card-title card-title-dash">Recent Register Users</h4>
                                            <?php
                                            // Fetch the last 4 registered users
                                            $recentUsers = $db->orderBy('created_at', 'DESC')->get('users', 4);

                                            if ($recentUsers):
                                                foreach ($recentUsers as $user):
                                            ?>
                                            <div class="list align-items-center border-bottom py-2">
                                                <div class="wrapper w-100">
                                                    <p class="mb-2 fw-medium"><?php echo htmlspecialchars($user['username']); ?></p>
                                                    <p class="mb-2 fw-medium"><?php echo htmlspecialchars($user['email']); ?></p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <i class="mdi mdi-calendar text-muted me-1"></i>
                                                            <p class="mb-0 text-small text-muted"><?php echo date('M d, Y', strtotime($user['created_at'])); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                endforeach;
                                            else:
                                                echo '<p>No recent users found.</p>';
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-lg-6 grid-margin stretch-card">
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
                                                        <?php
                                                        // Get top 3 trending courses
                                                        $trendingCourses = $db->where('label', 'Top Trending')->get('courses', 3);
                                                        foreach ($trendingCourses as $course):
                                                        ?>
                                                        <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                            <div class="d-flex">
                                                                <?php
                                                                $thumbnail = $course['thumbnail'];
                                                                $imageFileName = "../" . $thumbnail;
                                                                ?>
                                                                <img class="img-sm rounded-10" src="<?php echo htmlspecialchars($imageFileName); ?>" alt="profile">
                                                                <div class="wrapper ms-3">
                                                                    <p class="ms-1 mb-1 fw-bold"><?php echo htmlspecialchars($course['title']); ?></p>
                                                                    <small class="text-muted mb-0">No of students : <?php echo htmlspecialchars($course['no_of_students']); ?></small>
                                                                    <br>
                                                                    <small class="text-muted mb-0">Discount with amount : <?php echo htmlspecialchars($course['discount_with_amount']); ?></small>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            // Calculate time ago
                                                            $courseCreatedAt = new DateTime($course['created_at']);
                                                            $currentDate = new DateTime();
                                                            $interval = $currentDate->diff($courseCreatedAt);
                                                            $timeAgo = 'just now';

                                                            if ($interval->y > 0) {
                                                                $timeAgo = $interval->y . 'y ago';
                                                            } elseif ($interval->m > 0) {
                                                                $timeAgo = $interval->m . 'm ago';
                                                            } elseif ($interval->d > 0) {
                                                                $timeAgo = $interval->d . 'd ago';
                                                            } elseif ($interval->h > 0) {
                                                                $timeAgo = $interval->h . 'h ago';
                                                            } elseif ($interval->i > 0) {
                                                                $timeAgo = $interval->i . 'm ago';
                                                            }
                                                            ?>
                                                            <div class="text-muted text-small"><?php echo $timeAgo; ?></div>
                                                        </div>
                                                        <?php endforeach; ?>
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
