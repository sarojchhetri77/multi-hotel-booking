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
        'total_room',
     ];
     public function categories(){
        return $this->hasMany(Category::class,'hotel_id');
     }
}
