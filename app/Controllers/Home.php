<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    protected $helpers = ['custom'];
    public function index()
    {
        $userModel = new UserModel();
        $data = [
            'user' => $userModel->table('users')->where('email', session()->get('email'))->first()
        ];
        // var_dump($loggedIn['name']);
        return view('index', $data);
    }
}
