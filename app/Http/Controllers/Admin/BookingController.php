<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\booking;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookRoom(Request $request, $roomId)
    {
        $validated = $request->validate([
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'members' => 'required|integer|min:1',
        ]);
        $room = Room::findOrFail($roomId);
        $existingBooking = Booking::where('room_id', $room->id)
            ->where(function ($query) use ($validated) {
                $query->where('check_in_date', '<=', $validated['check_out_date'])
                    ->where('check_out_date', '>=', $validated['check_in_date']);
            })
            ->first();
        if ($existingBooking) {
            return redirect()->back()->with('error', 'Room is not available for these dates.');
        }

        // Create the booking
        $booking = new Booking([
            'user_id' => auth()->user()->id,
            'room_id' => $room->id,
            'hotel_id' => $room->hotel_id,
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'],
            'guest_count' => $validated['guest_count'],
            'status' => 'confirmed',
        ]);
        $booking->save();

        // Redirect to a confirmation page or send an email to the user
        return redirect()->route('booking.confirmation', $booking->id)
            ->with('success', 'Booking confirmed successfully!');
    }
}
