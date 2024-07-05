<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }

}
