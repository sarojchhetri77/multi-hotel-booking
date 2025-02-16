<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
      'hotel_id',
      'category_id',
      'thumbnail',
      'capacity',
      'no_of_adult',
      'no_of_children',
      'description',
      'room_number',
      'beds',
      'bed_type',
      'price_per_night',
      'has_wifi',
      'has_air_conditioning',
      'has_tv',
      'has_bathroom',
      'room_view',
      'status',  // available,booked,under_maintenance
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class,);
    }

    public function images(){
        return $this->hasMany(RoomImage::class);
    }
}
