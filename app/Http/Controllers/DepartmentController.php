<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::withCount('employees')->get();
        return view('department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:departments']
        ]);

        Department::create($validated);

        return redirect()->route('departments.index')->with('success', 'Berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('department.show', [
            'department' => Department::findOrFail($id),
            'employees' => Employee::where('department_id', $id)->latest()->get()
        ]);

        return view('deparment.show', compact('department', 'employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('department.edit', [
            'department' => Department::findOrFail($id),
        ]);

        return view('deparment.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $department = Department::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', Rule::unique('departments')->ignore($id)]
        ]);

        $department->update($validated);

        return redirect()->route('departments.index')->with('success', 'Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Department::findOrFail($id)->delete();

        return redirect()->route('departments.index')->with('success', 'Berhasil dihapus');
    }
}
