<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Users extends Seeder
{
    public function run()
    {
        helper('date');
        $data = [
            'email'    => 'aditya@gmail.com',
            'name' => 'Aditya Wira Utama',
            'password' => password_hash('akugakero', PASSWORD_DEFAULT),
            'profile_image' => 'default.svg',
            'created_at' => Time::now(),
            'updated_at' => Time::now()
        ];

        $this->db->table('users')->insert($data);
    }
}
