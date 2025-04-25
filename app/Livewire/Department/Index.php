<?php

namespace App\Livewire\Department;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Department;

class Index extends Component
{
  use WithPagination;

  public $search = '';

  public $checkAll = false;
  public $checkedItems = [];

  public function updatedCheckAll()
  {
    if ($this->checkAll) {
      $this->checkedItems = Department::pluck('id')
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

    Department::whereIn('id', $this->checkedItems)->delete();
    $this->checkedItems = [];
    $this->checkAll = false;
  }

  public function deleteDepartment($id)
  {
    $department = Department::findOrFail($id);
    // this need gate for authorization
    $department->delete();
  }

  public function render()
  {
    $filters = [
      'search' => $this->search,
    ];

    return view('livewire.department.index', [
      'departments' => Department::filter($filters)->withCount('employees')->paginate(10),
    ]);
  }
}
