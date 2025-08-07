<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'image','specialty', 'hire_date', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function schedules()
    {
        return $this->hasMany(EmployeeSchedule::class);
    }
}
