<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['hotel_id', 'name','email','rating', 'review'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

}
