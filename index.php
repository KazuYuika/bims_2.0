<?php
session_start();
require 'vendor/autoload.php';
$router = new \Bramus\Router\Router();
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$path = preg_replace('/^index\.php\//', '', $path);
$path = ltrim($path, '/');

use App\Models\ConfigModel;

$authController = new App\Controllers\AuthController();

require 'config.php';
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000000">
    <link rel="shortcut icon" href="resources/img/favicon.ico">
    <link rel="apple-touch-icon" sizes="76x76" href="apple-icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">

    <script src="resources/js/tailwindcss.js"></script>
    <script src="tailwind.config.js"></script>
    <title><?php echo $path . ' | ' . ConfigModel::get('name'); ?></title>
</head>


<?php
$router->get('/', function () {
    require $_SERVER['DOCUMENT_ROOT'] . '/resources/views/home.php';
});

$router->get('/login', function () use ($authController) {
    $authController->showLoginForm();
});

$router->post('/login', function () use ($authController) {
    $authController->login();
});

$router->get('/signup', function () use ($authController) {
    $authController->showSignupFrom();
});
$router->post('/signup', function () use ($authController) {
    $authController->signup();
});

$router->post('/logout', function () use ($authController) {
    $authController->logout();
});

$router->get('/dashboard', function () {
    require $_SERVER['DOCUMENT_ROOT'] . '/resources/views/dashboard.php';
});


$router->run();
?>