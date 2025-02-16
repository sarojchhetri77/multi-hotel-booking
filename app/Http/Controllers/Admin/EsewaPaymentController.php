<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BookingConfirmationMail;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Xentixar\EsewaSdk\Esewa;

class EsewaPaymentController extends Controller
{
      public function pay(Request $request){
          $selectedRooms = session('selected_rooms', []); 
          $sum = collect($selectedRooms)->sum('price_per_night');
          if ($sum > 0) {
            $transactionUuid = $this->generateTransactionUuid(Auth::id(), now()->timestamp);
            $esewa = new Esewa();
            $esewa->config(route('esewa.check'), route('esewa.check'), $sum,$transactionUuid);
            $esewa->init();
        }
    }
    public function check(Request $request)
    {
        $esewa = new Esewa();
        $data = $esewa->decode();
    
        // Check if the payment data is received and valid
        if ($data) {
            if ($data["status"] === 'COMPLETE') {
                $cart = session('selected_rooms', []);
                $msg = 'Payment successful';
                $totalAmount = 0;
    
                foreach ($cart as $item) {
                    $totalAmount += $data['total_amount']; 
    
                  $booking =  Booking::query()->create([
                        'user_id' => Auth::id(),
                        'hotel_id' => $item['hotel_id'],
                        'room_id' => $item['room_id'],
                        'payment_status' => 'payed',
                        'price' => $item['price_per_night'],
                        'check_in_date' => session('checkin'),
                        'check_out_date' => session('checkout'),
                        'booking_status' => 'booked'
                    ]);
                }
    
                session()->forget('cart');
                $user = Auth::user();
                Mail::to($user->email)->send(new BookingConfirmationMail($booking));
    
                return view('frontend.payment.success', [
                    'msg' => $msg
                ]);
            }
        }
    
        // Return failed payment view if payment is not complete or data is invalid
        return view('frontend.payment.failed');
    }

    protected function generateTransactionUuid($userId, $timestamp)
    {
        $inputString = $userId . '-' . $timestamp;
        $hash = hash('sha256', $inputString);
        $randomString = substr($hash, 0, 12);

        return $randomString;
    }
    
}
