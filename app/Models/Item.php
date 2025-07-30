<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'description',
        'price',
        'rarity',
    ];

    public function userItems()
    {
        return $this->hasMany(UserItem::class);
    }

}
