<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BookingConfirmationMail;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function bookRoom(Request $request)
    {
        $request->validate([
            'guest_name' => 'required_if:booking_for,other|string|max:255',
            'guest_phone' => 'required_if:booking_for,other|string|max:15',
            'arrival_time' => 'required_if:booking_for,other|date_format:H:i',
        ]);

        $user = auth()->user();
        $cart = session('selected_rooms', []);
        foreach ($cart as $item) {
            Log::info('Processing room booking.', ['room_id' => $item['room_id'], 'hotel_id' => $item['hotel_id']]);

            $bookingData = [
                'user_id' => $user->id,
                'hotel_id' => $item['hotel_id'],
                'room_id' => $item['room_id'],
                'payment_status' => 'Not Paid',
                'booking_status' => 'booked', 
                'price' => $item['price_per_night'],
                'check_in_date' => session('checkin'),
                'check_out_date' => session('checkout'),
            ];
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
                $bookingData['guest_name'] = $user->name;
                $bookingData['guest_phone'] = $request->phone;
                $bookingData['arrival_time'] = now()->format('H:i');
                Log::info('Booking for self.', ['guest_name' => $user->name, 'guest_phone' => $user->phone]);
            }

          $booking =  Booking::create($bookingData);
            Log::info('Booking created successfully.', ['booking_data' => $bookingData]);
        }

        session()->forget('selected_rooms');
        $user = Auth::user();
        Mail::to($user->email)->send(new BookingConfirmationMail($booking));
        return redirect()->route('booking.success')->with('success', 'Room(s) booked successfully!');
    }

    // public function paymentBook(Request $request){
    //     $request->validate([
    //         'guestName' => 'required|string|max:255',
    //         'guestPhone' => 'required|string|max:15',
    //         'arrivalTime' => 'required|date_format:H:i',
    //     ]);
    
    //     // Save booking logic here
    //     $booking = Booking::create([
    //         'user_id' => Auth::id(),
    //         'guest_name' => $request->guestName,
    //         'guest_phone' => $request->guestPhone,
    //         'arrival_time' => $request->arrivalTime,
    //         'payment_status' => 'Pending',
    //         'booking_status' => 'booked', 
    //     ]);
      
    
    //     // Redirect to the eSewa payment gateway with the booking ID
    //     return redirect()->route('esewa.pay', ['bookingId' => $booking->id]);
    // }

    public function paymentSuccess(){
        return view('frontend.payment.success');
    }

    public function paymentFailed(){
        return view('frontend.payment.failed');
    }

    public function cancelBooking(Request $request){
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
        ]);

        $booking = Booking::find($request->booking_id);
        $booking->booking_status = 'cancelled';
        $booking->save();

        return redirect()->back()->with('success', 'Booking cancelled successfully!');
    }
}
