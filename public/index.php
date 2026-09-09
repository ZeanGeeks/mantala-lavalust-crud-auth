<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

define('PREVENT_DIRECT_ACCESS', TRUE);

$system_path = 'scheme';
$application_folder = 'app';
$public_folder = 'public';

define('ROOT_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('SYSTEM_DIR', ROOT_DIR . $system_path . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . $application_folder . DIRECTORY_SEPARATOR);
define('PUBLIC_DIR', $public_folder);

require_once SYSTEM_DIR . 'kernel/LavaLust.php';