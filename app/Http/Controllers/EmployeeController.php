<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; // import employee model

class EmployeeController extends Controller
{
    // Dashboard
    public function index()
    {
        // To show all employeees
        $employees = Employee::all(); 

        // employee details send to  the view
        return view('employees.index', compact('employees'));

        
    }
    // 1.New employee create form
    public function create()
    {
        return view('employees.create');
    }

    // 2. Form data save in the database
    public function store(Request $request)
    {
        // check data validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'department' => 'required|string|max:255',
            'salary' => 'required|numeric',
        ]);

        // save into database
        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'salary' => $request->salary,
        ]);

        // After successfully save redirect the emplpoyes table
        return redirect('/employees')->with('success', 'Employee added successfully!');
    }

    // 3. show single employee (View)
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    // 4. Change the employee details (Edit)
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    // 5. Saved data update into database (Update)
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id, 
            'department' => 'required|string|max:255',
            'salary' => 'required|numeric',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'salary' => $request->salary,
        ]);

        return redirect('/employees')->with('success', 'Employee updated successfully!');
    }

    // 6. employee details (Delete)
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect('/employees')->with('success', 'Employee deleted successfully!');
    }
}