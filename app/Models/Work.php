<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
   use HasFactory;

    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'id_employee', 'main_image'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_employee', 'id');
    }

    public function galleryImages()
    {
        return $this->hasMany(WorkGallery::class, 'work_id', 'id');
    }
}
