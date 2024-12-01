<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
