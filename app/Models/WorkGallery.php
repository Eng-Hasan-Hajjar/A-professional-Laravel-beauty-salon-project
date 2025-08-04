<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkGallery extends Model
{
     use HasFactory;

    protected $fillable = ['work_id', 'image_path'];

    public function work()
    {
        return $this->belongsTo(Work::class, 'work_id', 'id');
    }
}
