<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employee'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['first_name', 'last_name', 'position', 'create_date'];


    protected $validationRules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'position' => 'required|in_list[Manager,Web Developer,Web Designer]',
    ];
}