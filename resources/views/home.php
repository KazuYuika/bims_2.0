<?php

use App\Models\Accounts;
use App\Models\ConfigModel;

$users = Accounts::all();
foreach ($users as $user) {
    echo $user->name;
}