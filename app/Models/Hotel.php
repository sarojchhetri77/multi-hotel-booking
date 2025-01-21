<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'district',
        'city',
        'street_no',
        'slug',
        'owner_id',
        'room_number',
        'thumbnail',
        'reject_message',
        'status',
     ];
     public function categories(){
        return $this->hasMany(Category::class,'hotel_id');
     }

     public function user(){
      return $this->belongsTo(User::class,'owner_id');
     }

     public function rooms(){
      return $this->hasMany(Room::class,'hotel_id');
     }
}
