<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class EmployeeSchedule extends Model
{
     use HasFactory;

    protected $fillable = ['employee_id', 'day_of_week', 'start_time', 'end_time', 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
