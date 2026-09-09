
<?php

/**
 * ---------------------------------------------------------------
 * OUTPUT BUFFERING
 * ---------------------------------------------------------------
 */
ob_start();

/**
 * ---------------------------------------------------------------
 * ERROR REPORTING
 * ---------------------------------------------------------------
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

/**
 * ---------------------------------------------------------------
 * PREVENT DIRECT ACCESS
 * ---------------------------------------------------------------
 */
define('PREVENT_DIRECT_ACCESS', TRUE);

/**
 * ---------------------------------------------------------------
 * START PHP SESSION
 * ---------------------------------------------------------------
 *
 * Start the session before LavaLust loads controllers,
 * middleware, views, or other application output.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 */

/**
 * ---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 * ---------------------------------------------------------------
 */
$system_path = 'scheme';

/**
 * ---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 * ---------------------------------------------------------------
 */
$application_folder = 'app';

/**
 * ---------------------------------------------------------------
 * PUBLIC DIRECTORY NAME
 * ---------------------------------------------------------------
 */
$public_folder = 'public';

/**
 * ------------------------------------------------------
 * Define Application Constants
 * ------------------------------------------------------
 */
define('ROOT_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('SYSTEM_DIR', ROOT_DIR . $system_path . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . $application_folder . DIRECTORY_SEPARATOR);
define('PUBLIC_DIR', $public_folder);

/**
 * ------------------------------------------------------
 * Load LavaLust
 * ------------------------------------------------------
 */
require_once SYSTEM_DIR . 'kernel/LavaLust.php';

/**
 * ---------------------------------------------------------------
 * SEND BUFFERED OUTPUT
 * ---------------------------------------------------------------
 */
ob_end_flush();