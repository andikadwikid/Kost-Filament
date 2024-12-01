<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }
}
