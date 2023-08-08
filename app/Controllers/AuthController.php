<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Config\Services;
use App\Models\UserModel;
use App\Models\EmployeeModel;

class AuthController extends BaseController
{

    public function index()
    {
        $userModel = new UserModel();
        $existingRecords = $userModel->countAllResults();

        if ($existingRecords === 0) {
            $defaultUsers = [
                [
                    'username' => 'webdesigner',
                    'password' => 'password', 
                    'name' => 'Kirby Hipona - Web Designer',
                    'role' => 'Web Designer',
                ],
                [
                    'username' => 'manager',
                    'password' => 'password', 
                    'name' => 'Kirby Hipona - Manager',
                    'role' => 'Manager',
                ],
                [
                    'username' => 'webdeveloper',
                    'password' => 'password', 
                    'name' => 'Kirby Hipona - Web Developer',
                    'role' => 'Web Developer',
                ],
            ];

            foreach ($defaultUsers as $userData) {
                $existingUser = $userModel->where('username', $userData['username'])->first();

                if (!$existingUser) {
                    $userModel->insert($userData);
                }
            }
        }
        return view('auth/login');
    }

    public function processLogin()
    {
        $request = service('request');
        $session = Services::session();

        $username = $request->getPost('username');
        $password = $request->getPost('password');


        $authenticated = $this->authenticateUser($username, $password);

        if ($authenticated) {
            $userRole = $this->getUserRole($username);
            $name = $this->getUserName($username);

            $userData = [
                'username' => $username,
                'role' => $userRole,
                'name' => $name,
            ];

            $session->set('user', $userData);
            return redirect()->to('/dashboard');
        } else {
            $session->setFlashdata('error', 'Invalid credentials.');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        $session = Services::session();
        $session->remove('user');
        return redirect()->to('/');
    }

    private function authenticateUser($username, $password)
    {
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)
            ->first();

        if ($user && password_verify($password, $user['password'])) {
            return true;
        }

        return false;
    }

    private function getUserRole($username)
    {
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)
            ->first();

        if ($user) {
            return $user['role'];
        }

        return null;
    }
    private function getUserName($username)
    {
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)
            ->first();

        if ($user) {
            return $user['name'];
        }

        return null;
    }
    public function insertByUrl()
    {
        $userModel = new UserModel();

        $data = [
            'username' => 'webdesigner',
            'password' => 'password', // Plain text password
            'name' => 'Kirby Hipona - Web Designer',
            'role' => 'Web Designer',
        ];
        $data = [
            'username' => 'manager',
            'password' => 'password', // Plain text password
            'name' => 'Kirby Hipona - Manager',
            'role' => 'Manager',
        ];
        $data = [
            'username' => 'webdeveloper',
            'password' => 'password', // Plain text password
            'name' => 'Kirby Hipona - Web Developer',
            'role' => 'Web Developer',
        ];

        $userModel->insert($data);
    }
}
