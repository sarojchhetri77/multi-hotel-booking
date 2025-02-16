<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelAboutUs extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id',
        'short_description',
        'long_description',
        'thumbnail',
    ];

}
