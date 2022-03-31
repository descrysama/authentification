<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attack extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip',
        'port',
        'length',
        'method',
        'sender_id'
    ];
}
