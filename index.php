<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
spl_autoload_register(function ($class) {
    $fileName = "$class.php";

    $fileModel = PATH_MODELS . $fileName;
    $fileControllerClient = PATH_CONTROLLER_CLIENT . $fileName;
    $fileControllerAdmin = PATH_CONTROLLER_ADMIN . $fileName;

    if (is_readable($fileModel)) {
        require_once $fileModel;
    } else if (is_readable($fileControllerClient)) {
        require_once $fileControllerClient;
    } else if (is_readable($fileControllerAdmin)) {
        require_once $fileControllerAdmin;
    }
});
require_once "./configs/env.php";
require_once "./configs/helper.php";
// debug(BASE_ASSETS_JS);die;

// debug($_SESSION);die;

$role = $_GET['role'] ?? 'client';

if ($role == 'admin') {
    require_once "./routes/admin.php";
} else {
    require_once "./routes/client.php";
}
