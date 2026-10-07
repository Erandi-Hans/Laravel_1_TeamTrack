<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; // අපි කලින් හැදූ Employee Model එක සම්බන්ධ කරගැනීම

class EmployeeController extends Controller
{
    // සියලුම සේවකයින් පෙන්වන ඩෑෂ්බෝඩ් මෙතඩ් එක
    public function index()
    {
        // ඩේටාබේස් එකෙන් සියලුම සේවකයින් ලබා ගැනීම
        $employees = Employee::all(); 

        // employees විස්තරය view එකට යැවීම
        return view('employees.index', compact('employees'));

        
    }
    // 1. අලුත් සේවකයෙක් එකතු කරන Form එක පෙන්වීම
    public function create()
    {
        return view('employees.create');
    }

    // 2. Form එකෙන් එන ඩේටා Database එකේ Save කරගැනීම
    public function store(Request $request)
    {
        // ඩේටා වලට Validation එකක් දාලා චෙක් කරගැනීම
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'department' => 'required|string|max:255',
            'salary' => 'required|numeric',
        ]);

        // Database එකට ඩේටා Save කිරීම
        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'salary' => $request->salary,
        ]);

        // සාර්ථකව සේව් වුණාම Employee List එකට ආපහු redirect කිරීම
        return redirect('/employees')->with('success', 'Employee added successfully!');
    }

    // 3. තනි සේවකයෙකුගේ විස්තර පෙන්වීම (View)
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    // 4. සේවකයෙකුගේ විස්තර වෙනස් කරන Form එක පෙන්වීම (Edit)
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    // 5. වෙනස් කළ ඩේටා ඩේටාබේස් එකේ Update කිරීම (Update)
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id, // තමන්ගේ ඊමේල් එක හැර වෙන එකක් චෙක් කිරීමට
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

    // 6. සේවකයෙක් ඉවත් කිරීම (Delete)
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect('/employees')->with('success', 'Employee deleted successfully!');
    }
}