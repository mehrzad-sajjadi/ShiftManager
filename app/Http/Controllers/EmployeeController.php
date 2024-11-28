<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index(){
        $employees = Employee::all();

        return Inertia::render("employee/index",compact("employees"));
    }


    public function create(){
        return Inertia::render("employee/create");
    }

    public function store(EmployeeRequest $employeeRequest){
        $employee = new Employee();
        $employee->name = $employeeRequest->name ;
 
        $employee->save();
        return redirect()->route("employee.index")->with("message","Employee Added Successfully");                
 
    }

    public function edit(Employee $employee){
        return Inertia::render("employee/edit",compact("employee"));
    }

    
    public function update(EmployeeRequest $employeeRequest,Employee $employee){
        $employee->name = $employeeRequest->name ;
        // $check = Employee::where("name", $employee->name)->get()->count();
        // if($check > 0){
        //     return redirect()->route("employee.edit",$employee->id)->withErrors("Employee with this name already added");                
        // }else{
        $employee->save();
        return redirect()->route("employee.index")->with("message","Employee Edited Successfully");                
        // }    
    }

    public function delete(Employee $employee){
        $employee->delete();
        return redirect()->route("employee.index")->with("message","Employee Deleted Successfully");
    }


    
    




}
