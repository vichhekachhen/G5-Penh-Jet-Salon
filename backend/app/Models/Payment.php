<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_id',
        'amount',
        'currency',
        'payment_method',
        'date',
        'zip_code',
    ];
}
