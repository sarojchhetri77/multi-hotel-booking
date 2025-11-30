<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelAboutUs extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id',
        'small_description',
        'long_description',
        'num_clients',
        'num_staff',
        'num_rooms',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

}
