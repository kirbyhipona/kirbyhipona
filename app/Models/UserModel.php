<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'name', 'role'];

    protected $validationRules = [
        'username' => 'required|alpha_numeric_space|min_length[3]|is_unique[user.username]',
        'password' => 'required|min_length[6]',
        'name' => 'required',
        'role' => 'required|in_list[Manager,Web Developer,Web Designer]',
    ];

    protected $beforeInsert = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}
