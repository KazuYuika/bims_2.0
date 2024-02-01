<?php
require 'vendor/autoload.php';
$router = new \Bramus\Router\Router();
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$path = preg_replace('/^index\.php\//', '', $path);
$path = ltrim($path, '/');

use App\Models\ConfigModel;

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
    <script src="resources/js/tailwindcss.js"></script>
    <script src="tailwind.config.js"></script>
    <title><?php echo $path . ' | ' . ConfigModel::get('name'); ?></title>
</head>


<?php
$router->get('/', function () {
    require $_SERVER['DOCUMENT_ROOT'] . '/resources/views/home.php';
});
$router->get('/login', function () {
    require $_SERVER['DOCUMENT_ROOT'] . '/resources/views/auth/login.php';
});
$router->get('/signup', function () {
    require $_SERVER['DOCUMENT_ROOT'] . '/resources/views/auth/signup.php';
});

$router->run();