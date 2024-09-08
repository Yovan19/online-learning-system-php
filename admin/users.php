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
$limit = 5; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = $page < 1 ? 1 : $page; // Ensure page is at least 1
$offset = ($page - 1) * $limit;

// Get total number of users
$totalUsers = $db->where('role', 'user')->getValue("users", "count(*)");

// Fetch user data for current page
$users = $db->where('role', 'user')->orderBy('id', 'ASC')->get('users', $limit, $offset);

// Calculate total pages
$totalPages = ceil($totalUsers / $limit);

// Define the base path of your admin directory
$adminBase = __DIR__; // Current directory, which is the 'admin' directory

// Include header
include_once $adminBase . '/includes/header.php';
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Users Listing</h4>
            <p class="card-description"> Users <code> / List</code></p>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>First name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Created Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)) : ?>
                            <tr>
                                <td colspan="5" class="text-center">No record found</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td class="py-1">
                                        <?php
                                        // Generate a random number between 1 and 27
                                        $randomNumber = rand(1, 27);
                                        
                                        // Construct the image file name
                                        $imageFileName = "../public/backend/images/faces/face" . $randomNumber . ".jpg";
                                        ?>
                                        <img src="<?php echo htmlspecialchars($imageFileName); ?>" alt="image" />
                                    </td>
                                    <td><?php echo isset($user['username']) ? htmlspecialchars($user['username']) : 'N/A'; ?></td>
                                    <td><?php echo isset($user['email']) ? htmlspecialchars($user['email']) : 'N/A'; ?></td>
                                    <td>
                                        <?php 
                                        // Determine the badge class based on status
                                        $statusClass = isset($user['status']) && $user['status'] === 'active' ? 'badge-opacity-success' : 'badge-opacity-danger'; 
                                        
                                        // Capitalize the first letter of the status
                                        $status = isset($user['status']) ? ucfirst(htmlspecialchars($user['status'])) : 'N/A';
                                        ?>
                                        <div class="badge <?php echo $statusClass; ?> me-3">
                                            <?php echo $status; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php 
                                        // Original date string
                                        $dateStr = isset($user['created_at']) ? $user['created_at'] : '';

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
