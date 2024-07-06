<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'service_id', 'text', 'images'
    ];

    // Define the relationship with Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
