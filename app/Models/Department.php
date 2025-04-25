<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'name'
  ];

  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? null, function ($query, $search) {
      $query->where('name', 'like', '%' . $search . '%');
    });
  }

  /**
   * Get all of the employees for the Department
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function employees(): HasMany
  {
    return $this->hasMany(Employee::class, 'department_id');
  }
}
