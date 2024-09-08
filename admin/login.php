<?php
include '../config.php';
require_once '../app/helpers.php';
session_start(); // Start session management

// Initialize variables
$email = $password = '';
$login_failure = '';

// Generate CSRF token for the form
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = getSecureRandomToken();
}
$token = $_SESSION['csrf_token'];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verify CSRF token
    if (empty($_POST['csrf_token']) || !hash_equals($token, $_POST['csrf_token'])) {
        $login_failure = 'Invalid CSRF token.';
        file_put_contents('debug.log', "CSRF token mismatch\n", FILE_APPEND);
    } else {
        // Clean user input
        $email = clean_input($_POST['email']);
        $password = clean_input($_POST['password']);
        $remember = isset($_POST['remember']);

        // Validate input
        if (empty($email) || empty($password)) {
            $login_failure = 'Email and password are required.';
            file_put_contents('debug.log', "Empty email or password\n", FILE_APPEND);
        } else {
            // Get database instance
            $db = getDbInstance();
            if ($db === false) {
                $login_failure = 'Database connection error.';
                file_put_contents('debug.log', "Database connection error\n", FILE_APPEND);
            } else {
                // Prepare SQL query
                $db->where('email', $email);
                $user = $db->getOne('users');
                
                if (!$user) {
                    $login_failure = 'Invalid email or password.';
                    file_put_contents('debug.log', "Invalid login attempt for email: $email\n", FILE_APPEND);
                } else {
                    // Check if the password hash matches
                    $isPasswordCorrect = password_verify($password, $user['password']);
                    
                    if ($isPasswordCorrect) {
                        // Set session variables
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['user_logged_in'] = true; // Add this line

                        // Handle "Remember Me" functionality
                        if ($remember) {
                            $token = getSecureRandomToken();
                            $expiry = date('Y-m-d H:i:s', time() + (86400 * 30)); // 30 days expiration

                            // Store the token and expiration in the database
                            $db->where('email', $email);
                            $db->update('users', [
                                'remember' => $remember,
                                'remember_token' => $token,
                                'expires' => $expiry
                            ]);

                            setcookie('remember_token', $token, time() + (86400 * 30), "/");
                            setcookie('id', $user['id'], time() + (86400 * 30), "/");
                        }

                        // Redirect to dashboard or another page
                        file_put_contents('debug.log', "Superadmin login now! with : $email\n", FILE_APPEND);
                        header('location: index.php');
                        exit();
                    } else {
                        $login_failure = 'Invalid email or password.';
                        file_put_contents('debug.log', "Invalid login attempt for email: $email\n", FILE_APPEND);
                    }
                }
            }
        }
    }

    // Store failure message in session
    $_SESSION['login_failure'] = $login_failure;
    file_put_contents('debug.log', "Login failure: $login_failure\n", FILE_APPEND);

    // Redirect to login page with failure message
    header('Location: login.php');
    exit();
}

include 'includes/header.php';
?>

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo">
                            <img src="../public/backend/images/logo.svg" alt="logo">
                        </div>
                        <h4>Hello! Let's get started</h4>
                        <h6 class="fw-light">Sign in to continue.</h6>
                        <form class="pt-3" method="post" action="">
                            
                            <?php if (isset($_SESSION['login_failure'])): ?>
                                <div class="alert alert-danger alert-dismissable fade-in mt-3">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $_SESSION['login_failure']; unset($_SESSION['login_failure']); ?>
                                </div>
                            <?php endif; ?>

                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($token); ?>">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                <label for="remember">Remember Me</label>
                            </div>
                            <div class="mt-3 d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg fw-medium auth-form-btn">SIGN IN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
ob_end_flush(); // Ensure all output is sent
?>
