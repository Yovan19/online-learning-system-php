<?php
session_start();
require_once '../config.php';
require_once '../admin/includes/auth_validate.php';

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

// Get DB instance
$db = getDbInstance();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $label = $_POST['label'];
    $no_of_star = $_POST['no_of_star'];
    $amount = $_POST['amount'];
    $discount_with_amount = $_POST['discount_with_amount'];
    $no_of_weeks = $_POST['no_of_weeks'];
    $no_of_lessons = $_POST['no_of_lessons'];
    $no_of_students = $_POST['no_of_students'];
    $status = $_POST['status'];
    
    // Handle file upload
    $thumbnail = '';
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['thumbnail']['tmp_name'];
        $fileName = $_FILES['thumbnail']['name'];
        $fileSize = $_FILES['thumbnail']['size'];
        $fileType = $_FILES['thumbnail']['type'];
        $fileNameCmps = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define allowed file extensions
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        
        if (in_array($fileExtension, $allowedExtensions)) {
            // Directory where the file will be saved
            $uploadFileDir = '../public/uploads/';
            
            // Ensure the directory exists
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true); // Create the directory if it does not exist
            }
            
            $dest_path = $uploadFileDir . $fileName;

            // Move the file to the upload directory
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $thumbnail = $dest_path; // Save the file path in the database
            } else {
                $_SESSION['failure'] = 'Failed to move uploaded file.';
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit();
            }
        } else {
            $_SESSION['failure'] = 'Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.';
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    // Insert the new course into the database
    $data = array(
        'title' => $title,
        'description' => $description,
        'thumbnail' => $thumbnail,
        'label' => $label,
        'no_of_star' => $no_of_star,
        'amount' => $amount,
        'discount_with_amount' => $discount_with_amount,
        'no_of_weeks' => $no_of_weeks,
        'no_of_lessons' => $no_of_lessons,
        'no_of_students' => $no_of_students,
        'status' => $status,
    );

    $insertId = $db->insert('courses', $data);

    if ($insertId) {
        $_SESSION['success'] = 'Course added successfully!';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $_SESSION['failure'] = 'Failed to add course.';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Include header
include_once __DIR__ . '/includes/header.php';
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add New Course</h4>
            <p class="card-description"> Fill in the details to add a new course. </p>
            
            <?php include_once __DIR__ . '/includes/flash_messages.php'; ?>

            
            <form method="post" action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Course Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail Image</label>
                            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="label">Label</label>
                            <select class="form-control" id="label" name="label" required>
                                <option value="Top Trending">Top Trending</option>
                                <option value="Free Courses">Free Courses</option>
                                <option value="New Courses">New Courses</option>
                                <option value="Web Development">Web Development</option>
                                <option value="Mobile Development">Mobile Development</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Advanced">Advanced</option>
                                <option value="Game Development">Game Development</option>
                                <option value="Analytics">Analytics</option>
                                <option value="Hacking">Hacking</option>
                                <option value="Full Stack Development">Full Stack Development</option>
                                <option value="JavaScript">JavaScript</option>
                                <option value="Python">Python</option>
                                <option value="Software testing">Software testing</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_of_star">Number of Stars (Rating)</label>
                            <input type="number" class="form-control" id="no_of_star" name="no_of_star" min="0" max="5" step="0.1" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="discount_with_amount">Discount (Text and Number)</label>
                            <input type="text" class="form-control" id="discount_with_amount" name="discount_with_amount">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_of_weeks">Number of Weeks</label>
                            <input type="number" class="form-control" id="no_of_weeks" name="no_of_weeks">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_of_lessons">Number of Lessons</label>
                            <input type="number" class="form-control" id="no_of_lessons" name="no_of_lessons">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_of_students">Number of Students</label>
                            <input type="number" class="form-control" id="no_of_students" name="no_of_students">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="published">Published</option>
                        <option value="unpublished">Unpublished</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Course</button>
            </form>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/includes/footer.php'; ?>
