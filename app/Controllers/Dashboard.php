<?php


namespace App\Controllers;

use CodeIgniter\Config\Services;
use App\Models\EmployeeModel;


class Dashboard extends BaseController
{
    public function index()
    {
        $employeeModel = new EmployeeModel();
        $employees = $employeeModel->findAll();
        $userRole = $this->getUserRole();
        $userName = $this->getUserName();
        $data = [
            'employees' => $employees,
            'userRole' => $userRole, 
            'userName' => $userName, 
        ];

        return view('admin/dashboard', $data);
    }

    public function store()
    {
        $session = Services::session();
        $employeeModel = new EmployeeModel();

        $validation = Services::validation();

        $validationRules = $employeeModel->validationRules;
        $userRole = $this->getUserRole();

        if ($validation->setRules($validationRules)->withRequest($this->request)->run()) {
            $data = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'position' => $this->request->getPost('position'),
            ];
            $allowedPositions = $this->getAllowedPositionsForRole($userRole);

            if ($userRole === 'Manager' || in_array($data['position'], $allowedPositions)) {
                if ($employeeModel->insert($data)) {
                    $session->setFlashdata('success', 'Successfully inserted.');
                } else {
                    $session->setFlashdata('error', 'Save unsuccessful..');
                }
            } else {
                $session->setFlashdata('error', 'You are not allowed to add an employee with this position.');
            }
        } else {
            // Validation failed, store validation errors in session
            $session->setFlashdata('errors', $validation->getErrors());
        }

        return redirect()->to('/dashboard');
    }
    public function update($id)
    {
        $employeeModel = new EmployeeModel();
        $validation = Services::validation();
        $session = Services::session();

    
        $validationRules = $employeeModel->validationRules;

        $userRole = $this->getUserRole();
    
   
        if ($validation->setRules($validationRules)->withRequest($this->request)->run()) {
          
            $data = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'position' => $this->request->getPost('position'),
            ];

            // $allowedPositions = $this->getAllowedPositionsForRole($userRole);

            $employee = $employeeModel->find($id);
            $employeePosition = $employee['position'];

            if ($userRole === 'Manager' || ($userRole === 'Web Developer' && $employeePosition === 'Web Developer') || ($userRole === 'Web Designer' && $employeePosition === 'Web Designer')) {
                if ($employeeModel->update($id, $data)) {
                    $session->setFlashdata('success', 'Employee details updated successfully.');
                } else {
                    $session->setFlashdata('error', 'Update unsuccessful.');
                }
            } else {
                $session->setFlashdata('error', 'You are not allowed to update this employee.');
            }
        } else {
            // Validation failed, store validation errors in session
            $session->setFlashdata('errors', $validation->getErrors());
        }

        return redirect()->to('/dashboard');
    }

    public function delete($id)
    {
        $employeeModel = new EmployeeModel();
        $session = Services::session();

        // Retrieve employee's position
        $employee = $employeeModel->find($id);
        $employeePosition = $employee['position'];

        // Check user role to determine allowed positions
        $userRole = $this->getUserRole();

        // Retrieve allowed positions based on user role from database
        $allowedPositions = $this->getAllowedPositionsForRole($userRole);

        if ($userRole === 'Manager' || in_array($employeePosition, $allowedPositions)) {
            // Delete the employee
            if ($employeeModel->delete($id)) {
                $session->setFlashdata('success', 'Employee deleted successfully.');
            } else {
                $session->setFlashdata('error', 'Failed to delete employee.');
            }
        } else {
            $session->setFlashdata('error', 'You are not allowed to delete this employee.');
        }

        return redirect()->to('/dashboard');
    }

    public function get_employee($employeeId)
    {
        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->find($employeeId);

        if ($employee) {
            return $this->response->setJSON($employee);
        } else {
            return $this->response->setStatusCode(404);
        }
    }
    private function getUserRole()
    {
        $session = Services::session();
        $currentUser = $session->get('user');
        return $currentUser['role'];
    }
    private function getUserName()
    {
        $session = Services::session();
        $currentUser = $session->get('user');
        return $currentUser['name'];
    }

    private function getAllowedPositionsForRole($userRole)
    {

        $allowedPositions = [];

        if ($userRole === 'Web Developer') {
            $allowedPositions = ['Web Developer'];
        } elseif ($userRole === 'Web Designer') {
            $allowedPositions = ['Web Designer'];
        }

        return $allowedPositions;
    }
}
