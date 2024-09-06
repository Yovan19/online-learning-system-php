<?php
// login_process.php
session_start();
include '../config.php';

// Retrieve form data
$email = $_POST['email'];
$password = md5($_POST['password']); // Use bcrypt or another method for better security

// Validate credentials
$sql = "SELECT * FROM users WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // Successful login
    $_SESSION['email'] = $email;
    $_SESSION['role'] = $result->fetch_assoc()['role']; // Assuming role is stored in the database
    header('Location: dashboard.php'); // Redirect to the dashboard or another page
} else {
    // Failed login
    header('Location: login.php?error=invalid'); // Redirect back to login with an error message
}

$stmt->close();
$conn->close();
?>
