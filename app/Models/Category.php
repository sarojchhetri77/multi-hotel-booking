<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
       'title',
       'slug',
       'hotel_id',
    ];

    public function hotel(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }
    public function rooms(){
        return $this->hasMany(Room::class,'category_id');
    }
}
