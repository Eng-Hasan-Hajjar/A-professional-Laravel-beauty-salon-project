<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
      use HasFactory;

    protected $fillable = ['name', 'description', 'discount_percentage', 'start_date', 'end_date', 'status'];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'offer_services')
                    ->withTimestamps();
    }
}
