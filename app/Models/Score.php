<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'level',
        'score',
    ];
    protected $casts = [
        'keyboard_bindings' => 'array',
        'gamepad_bindings' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
