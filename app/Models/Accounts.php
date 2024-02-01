<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use this Accounts class to authenticate users and get their information from the Accounts table
// // CREATE TABLE `accounts` (
//   `id` int(11) NOT NULL AUTO_INCREMENT,
//   `username` varchar(20) NOT NULL,
//   `password` varchar(255) DEFAULT NULL,
//   `email` varchar(50) NOT NULL,
//   `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
//   `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
//   `role` varchar(55) DEFAULT NULL,
//   `permissions` text DEFAULT NULL,
//   `verified` tinyint(1) DEFAULT NULL,
//   `image_url` varchar(255) NOT NULL DEFAULT 'bot.png',
//   `notifications` text DEFAULT NULL,
//   `email_notifications` text DEFAULT NULL,
//   PRIMARY KEY (`id`)
// ) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
class Accounts extends Model
{
    // use SoftDeletes;
    protected $table = 'accounts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'username',
        'password',
        'email',
        'created_at',
        'updated_at',
        'role',
        'permissions',
        'verified',
        'image_url',
        'notifications',
        'email_notifications',
    ];
    // protected $dates = ['deleted_at'];
    public $timestamps = true;
}