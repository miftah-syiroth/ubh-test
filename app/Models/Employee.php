<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Employee extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'department_id',
    'name',
    'position',
    'salary',
  ];

  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? null, function ($query, $search) {
      $query->where('name', 'like', '%' . $search . '%')
        ->orWhere('position', 'like', '%' . $search . '%')
        ->orWhere('salary', 'like', '%' . $search . '%')
        ->orWhereHas('department', function (Builder $query) use ($search) {
          $query->where('name', 'like', '%' . $search . '%');
        });
    });
  }


  /**
   * Get the department that owns the Employee
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function department(): BelongsTo
  {
    return $this->belongsTo(Department::class, 'department_id');
  }
}
