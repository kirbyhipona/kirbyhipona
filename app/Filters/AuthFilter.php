<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


class AuthFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {

        $session = session();
        $currentUser = $session->get('user');

        if (!$currentUser) {
            return redirect()->to('/');
        }
        $allowedRoles = ['Manager', 'Web Developer', 'Web Designer'];
        $userRole = $currentUser['role'];

        if (!in_array($userRole, $allowedRoles)) {
            $session->setFlashdata('error', 'Account is not allowed to access this.');
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed
    }
}
