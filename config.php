<?php
//Note: This file should be included first in every php page.
error_reporting(E_ALL);
ini_set('display_errors', 'On');
define('BASE_PATH', dirname(dirname(__FILE__)));
define('APP_FOLDER', 'simpleadmin');
define('CURRENT_PAGE', basename($_SERVER['REQUEST_URI']));

require_once BASE_PATH . '/online-learning-system-php/lib/MysqliDb.php';
require_once BASE_PATH . '/online-learning-system-php/app/helpers.php';

// Database configuration
define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "");
define('DB_NAME', "online_learning_system");
// define('DB_PORT', "3307"); //3306
define('DB_PORT', "3306"); //3306

/**
 * Get instance of DB object
 */
function getDbInstance() {
    return new MysqliDb(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
}

// Example usage of getDbInstance()
$db = getDbInstance();

// Check connection
if (!$db->rawQuery("SELECT 1")) {
    die("Connection failed: " . $db->getLastError());
}
?>
