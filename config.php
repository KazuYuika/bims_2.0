<?php

use App\Models\ConfigModel;
use Illuminate\Database\Capsule\Manager as Capsule;

$host = ConfigModel::get('connection')['host'];
$port = ConfigModel::get('connection')['port'];
$user = ConfigModel::get('connection')['user'];
$pass = ConfigModel::get('connection')['pass'];
$database = ConfigModel::get('connection')['database'];

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $host,
    'database'  => $database,
    'username'  => $user,
    'password'  => $pass,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();