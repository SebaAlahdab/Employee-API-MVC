<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateEmployeeRequest;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    public  $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    // GET /api/employees
    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();

        return response()->json($employees, 200);
    }

    // POST /api/employees
    public function store(ValidateEmployeeRequest $request)
    {
        $validatedData = $request->validated();

        $employee = $this->employeeService->createEmployee($validatedData);

        return response()->json($employee, 201);
    }
}