<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Support\Facades\Log;
use Throwable;

class EmployeeService
{
    public function getAllEmployees()
    {
        try {
            return Employee::all();

        } catch (Throwable $e) {
            Log::error('Failed to retrieve employees', [
                'exception' => $e,
            ]);

            throw $e;
        }
    }

    public function getEmployeeById($id)
    {
        try {
            return Employee::findOrFail($id);

        } catch (Throwable $e) {
            Log::error('Failed to retrieve employee', [
                'employee_id' => $id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }

    public function createEmployee(array $data)
    {
        try {
            $employee = Employee::create($data);

            Log::info('Employee created successfully', [
                'employee_id' => $employee->id,
            ]);

            return $employee;

        } catch (Throwable $e) {
            Log::error('Failed to create employee', [
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}