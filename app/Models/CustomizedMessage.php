<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizedMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message',
        'type',
        'delivery_mode',
        'employee_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
