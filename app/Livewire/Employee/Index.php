<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;


class Index extends Component
{
  use WithPagination;

  public $search = '';

  public $checkAll = false;
  public $checkedItems = [];

  public function updatedCheckAll()
  {
    if ($this->checkAll) {
      $this->checkedItems = Employee::pluck('id')
        ->toArray();
    } else {
      $this->checkedItems = [];
    }
  }

  public function bulkDelete()
  {
    $this->validate([
      'checkedItems' => ['required', 'array']
    ]);

    Employee::whereIn('id', $this->checkedItems)->delete();
    $this->checkedItems = [];
    $this->checkAll = false;
  }

  public function deleteDepartment($id)
  {
    $employee = Employee::findOrFail($id);
    // this need gate for authorization
    $employee->delete();
  }

  public function render()
  {
    $filters = [
      'search' => $this->search,
    ];
    return view('livewire.employee.index', [
      'employees' => Employee::filter($filters)->with('department')->paginate(10),
    ]);
  }
}
