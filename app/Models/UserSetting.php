<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'master_volume',
        'music_volume',
        'sfx_volume',
        'keyboard_bindings',
    ];
    protected $casts = [
        'keyboard_bindings' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
