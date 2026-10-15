<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateEmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

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

    // GET /api/employees/{id}
    public function show($id)
    {
        $employee = $this->employeeService->getEmployeeById($id);

        return response()->json($employee, 200);
    }
    
    // GET /api/employees/email?email=john@example.com
        public function showByEmail(Request $request)
        {
            $request->validate([
                'email' => 'required|email',
            ]);

            $email = $request->query('email');

            $employee = $this->employeeService->getEmployeeByEmail($email);

            return response()->json($employee, 200);
        }

    // POST /api/employees
    public function store(ValidateEmployeeRequest $request)
    {
        $validatedData = $request->validated();

        $employee = $this->employeeService->createEmployee($validatedData);

        return response()->json($employee, 201);
    }
}