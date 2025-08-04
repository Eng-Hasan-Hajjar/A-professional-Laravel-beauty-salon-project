<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
      use HasFactory;

    protected $fillable = ['name', 'description', 'quantity', 'unit_price', 'minimum_stock'];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_inventory')
                    ->withPivot('quantity_used')
                    ->withTimestamps();
    }
}
