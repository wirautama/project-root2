<?php

use App\Models\UserModel;

function userLogin()
{
    $userModel = new UserModel();
    return $userModel->table('users')->where('email', session()->get('email'))->first();
}
