<?php
// session_start(); // Ensure the session is started

// Log unauthorized access attempt
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    file_put_contents('debug.log', "Unauthorized access attempt detected.\n", FILE_APPEND);
    header('Location: login.php');
    exit();
}
?>
