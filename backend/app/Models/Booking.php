<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_id',
        'total_price',
        'date',
        'time',
        'indebte',
        'pay',
    ];
    public function store()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }
    // public function services()
    // {
    //     return $this->belongsToMany(Service::class, 'service_id', 'id');
    //                 // Add any additional pivot table fields here
    // }
}

