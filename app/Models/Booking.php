<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'room_id',
        'hotel_id',
        'check_in_date',
        'check_out_date',
        'payment_status',
        'guest_name',
        'guest_phone',
        'arrival_time',
        'booking_status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
