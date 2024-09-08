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

// Pagination setup
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure page is at least 1
$offset = ($page - 1) * $limit;

// Get total number of courses
$totalCourses = $db->getValue("courses", "count(*)");

// Fetch course data for current page
$courses = $db->orderBy('id', 'DESC')->get('courses', $limit, $offset);

// Calculate total pages
$totalPages = ceil($totalCourses / $limit);

// Define the base path of your admin directory
$adminBase = __DIR__; // Current directory, which is the 'admin' directory

// Include header
include_once $adminBase . '/includes/header.php';
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Courses Listing</h4>
            <p class="card-description"> Courses <code>/ List</code></p>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Title</th>
                            <th>Label</th>
                            <th>No of Stars</th>
                            <th>Amount</th>
                            <th>Discount Amount</th>
                            <th>No of Weeks</th>
                            <th>No of Lessons</th>
                            <th>No of Students</th>
                            <th>Status</th>
                            <th>Created Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($courses)) : ?>
                            <tr>
                                <td colspan="11" class="text-center">No record found</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($courses as $course) : ?>
                                <tr>
                                    <td class="py-1">
                                        <?php
                                        // Generate a random number between 1 and 27
                                        
                                        // Construct the image file name
                                        $thumbnail = $course['thumbnail'];
                                        $imageFileName = "../online-learning-system-php/" . $thumbnail;
                                        ?>
                                        <img src="<?php echo htmlspecialchars($imageFileName); ?>" alt="Course Image" />
                                    </td>
                                    <td><?php echo isset($course['title']) ? htmlspecialchars($course['title']) : 'N/A'; ?></td>
                                    <td><?php echo isset($course['label']) ? htmlspecialchars($course['label']) : 'N/A'; ?></td>
                                    <td><?php echo isset($course['no_of_star']) ? htmlspecialchars($course['no_of_star']) : 'N/A'; ?></td>
                                    <td><?php echo isset($course['amount']) ? htmlspecialchars($course['amount']) : 'N/A'; ?></td>
                                    <td><?php echo isset($course['discount_with_amount']) ? htmlspecialchars($course['discount_with_amount']) : 'N/A'; ?></td>
                                    <td><?php echo isset($course['no_of_weeks']) ? htmlspecialchars($course['no_of_weeks']) : 'N/A'; ?></td>
                                    <td><?php echo isset($course['no_of_lessons']) ? htmlspecialchars($course['no_of_lessons']) : 'N/A'; ?></td>
                                    <td><?php echo isset($course['no_of_students']) ? htmlspecialchars($course['no_of_students']) : 'N/A'; ?></td>
                                    <td>
                                        <?php 
                                        // Determine the badge class based on status
                                        $statusClass = isset($course['status']) && $course['status'] === 'published' ? 'badge-opacity-success' : 'badge-opacity-danger'; 
                                        
                                        // Capitalize the first letter of the status
                                        $status = isset($course['status']) ? ucfirst(htmlspecialchars($course['status'])) : 'N/A';
                                        ?>
                                        <div class="badge <?php echo $statusClass; ?> me-3">
                                            <?php echo $status; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php 
                                        // Original date string
                                        $dateStr = isset($course['created_at']) ? $course['created_at'] : '';

                                        if ($dateStr) {
                                            // Create a DateTime object from the original date string
                                            $date = new DateTime($dateStr);

                                            // Format the date to the desired format
                                            $formattedDate = $date->format('d-m-Y h:i A');
                                            
                                            // Output the formatted date
                                            echo htmlspecialchars($formattedDate);
                                        } else {
                                            echo 'N/A';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo max($page - 1, 1); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo $page >= $totalPages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo min($page + 1, $totalPages); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php include_once $adminBase . '/includes/footer.php'; ?>
