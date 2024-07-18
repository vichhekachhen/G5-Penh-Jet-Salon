<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;

class sender extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'message',
        'message_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function message(){
        return $this->belongsTo(Message::class);
    }
}
