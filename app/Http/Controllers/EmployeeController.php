<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        // you can do filter here
        // $filters = request()->all();

        $employees = Employee::with('department')->latest()->get();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create', [
            'departments' => Department::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'name' => ['required', 'string'],
            'position' => ['required', 'string', Rule::in(['MANAGER', 'ADMIN', 'STAFF'])],
            'salary' => ['required', 'integer'],
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('employee.show', [
            'employee' => Employee::findOrFail($id)
        ]);

        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('employee.edit', [
            'departments' => Department::get(),
            'employee' => Employee::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'name' => ['required', 'string'],
            'position' => ['required', 'string', Rule::in(['MANAGER', 'ADMIN', 'STAFF'])],
            'salary' => ['required', 'integer'],
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employee::findOrFail($id)->delete();

        return redirect()->route('employees.index')->with('success', 'Berhasil dihapus');
    }
}
