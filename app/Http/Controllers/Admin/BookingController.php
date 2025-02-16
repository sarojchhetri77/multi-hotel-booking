<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function bookRoom(Request $request)
    {
        Log::info('Booking process started.', ['user_id' => Auth::id()]);

        // Validate the request data
        $request->validate([
            'guest_name' => 'required_if:booking_for,other|string|max:255',
            'guest_phone' => 'required_if:booking_for,other|string|max:15',
            'arrival_time' => 'required_if:booking_for,other|date_format:H:i',
        ]);
        Log::info('Request data validated.', ['request_data' => $request->all()]);

        $user = auth()->user();
        Log::info('Authenticated user retrieved.', ['user' => $user]);

        $cart = session('selected_rooms', []);
        Log::info('Retrieved selected rooms from session.', ['cart' => $cart]);

        // Loop through the cart and create bookings
        foreach ($cart as $item) {
            Log::info('Processing room booking.', ['room_id' => $item['room_id'], 'hotel_id' => $item['hotel_id']]);

            $bookingData = [
                'user_id' => $user->id,
                'hotel_id' => $item['hotel_id'],
                'room_id' => $item['room_id'],
                'payment_status' => 'Not Paid',
                'price' => $item['price_per_night'],
                'check_in_date' => now(),
                'check_out_date' => now()->addDay(),
            ];
            Log::info('Booking data prepared.', ['booking_data' => $bookingData]);

            // If the booking is for someone else, add guest details
            if ($request->booking_for === 'other') {
                $bookingData['guest_name'] = $request->guest_name;
                $bookingData['guest_phone'] = $request->guest_phone;
                $bookingData['arrival_time'] = $request->arrival_time;
                Log::info('Booking for another guest.', [
                    'guest_name' => $request->guest_name,
                    'guest_phone' => $request->guest_phone,
                    'arrival_time' => $request->arrival_time,
                ]);
            } else {
                // If the booking is for the user, use their details
                $bookingData['guest_name'] = $user->name;
                $bookingData['guest_phone'] = $request->phone;
                $bookingData['arrival_time'] = now()->format('H:i');
                Log::info('Booking for self.', ['guest_name' => $user->name, 'guest_phone' => $user->phone]);
            }

            // Create the booking
            Booking::create($bookingData);
            Log::info('Booking created successfully.', ['booking_data' => $bookingData]);
        }

        // Clear the cart after booking
        session()->forget('selected_rooms');
        Log::info('Cart cleared after booking.');

        // Redirect to a success page or return a response
        Log::info('Redirecting to success page.');
        return redirect()->route('booking.success')->with('success', 'Room(s) booked successfully!');
    }

    public function paymentBook(Request $request){
        $request->validate([
            'guestName' => 'required|string|max:255',
            'guestPhone' => 'required|string|max:15',
            'arrivalTime' => 'required|date_format:H:i',
        ]);
    
        // Save booking logic here
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'guest_name' => $request->guestName,
            'guest_phone' => $request->guestPhone,
            'arrival_time' => $request->arrivalTime,
            'payment_status' => 'Pending', // Set payment status as pending
        ]);
    
        // Redirect to the eSewa payment gateway with the booking ID
        return redirect()->route('esewa.pay', ['bookingId' => $booking->id]);
    }
}
