<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateEmployeeRequest;
use App\Services\EmployeeService;
use App\Traits\ApiResponse;
class EmployeeController extends Controller
{
    use ApiResponse;
    public  $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    // GET /api/employees
    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();

         return $this->successResponse(
            $employees,
            'Employees retrieved successfully'
        );
    }

    // GET /api/employees/{id}
    public function show($id)
    {
        $employee = $this->employeeService->getEmployeeById($id);

        return $this->successResponse(
            $employee,
            'Employee retrieved successfully'
        );
    }
    
    // POST /api/employees
    public function store(ValidateEmployeeRequest $request)
    {
        $validatedData = $request->validated();

        $employee = $this->employeeService->createEmployee($validatedData);

         return $this->successResponse(
            $employee,
            'Employee stored successfully'
        );
    }
}