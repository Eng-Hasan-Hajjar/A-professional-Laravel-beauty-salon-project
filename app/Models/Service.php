<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'category_id',
        'status',
        'image',
        'availability',
        'target_audience',
        'requirements',
        'featured'
    ];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_services')
                    ->withPivot('price')
                    ->withTimestamps();
    }

    public function inventory()
    {
        return $this->belongsToMany(Inventory::class, 'service_inventory')
                    ->withPivot('quantity_used')
                    ->withTimestamps();
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer_services')
                    ->withTimestamps();
    }
}