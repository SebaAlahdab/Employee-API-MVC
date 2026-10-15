<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService
{
    public function getAllEmployees()
    {
        return Employee::all();
    }
    public function getEmployeeById($id)
    {
        return Employee::findOrFail($id);
    }
    public function getEmployeeByEmail($email)
    {
        return Employee::where('email', $email)->firstOrFail();
    }

    public function createEmployee(array $data)
    {
        return Employee::create($data);
    }
}