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

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create a course</h4>
            <p class="card-description"> Create a course </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword4">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleSelectGender">Gender</label>
                    <select class="form-select" id="exampleSelectGender">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>File upload</label>
                    <input type="file" name="img[]" class="file-upload-default">
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputCity1">City</label>
                    <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Textarea</label>
                    <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>


<?php include_once $adminBase . '/includes/footer.php'; ?>