<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = [];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }

    public function images()
    {
        return $this->belongsTo(RoomImage::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
