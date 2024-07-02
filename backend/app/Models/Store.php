<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_name',
        'shop_profile',
        'address_id'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class,'address_id','id');
    }
}
