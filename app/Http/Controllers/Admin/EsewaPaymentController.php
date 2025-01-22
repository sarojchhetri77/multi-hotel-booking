<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Xentixar\EsewaSdk\Esewa;

class EsewaPaymentController extends Controller
{
      public function pay(Request $request){
        $selectedRooms = session('selected_rooms', []); // Fetch selected rooms from session

        // Calculate the total price of selected rooms
        $sum = collect($selectedRooms)->sum('price_per_night');
        
        if ($sum > 0) {
            // Initialize the Esewa payment process
            $esewa = new Esewa();
            $esewa->config(route('esewa.check'), route('esewa.check'), $sum, 111111222222211);
            
        
            $esewa->init();
        }
    }
    public function check(Request $request)
    {
        $esewa = new Esewa();
        $data = $esewa->decode();
    
        // Check if the payment data is received and valid
        if ($data) {
            // Verify if payment status is COMPLETE
            if ($data["status"] === 'COMPLETE') {
                // Retrieve the cart data from the session
                $cart = session('cart', []); // Default to an empty array if no cart in session
                $msg = 'Payment successful';
                $totalAmount = 0;
    
                // Process each cart item and create bookings
                foreach ($cart as $item) {
                    // Calculate the total amount (could be cart price or based on response)
                    $totalAmount += $data['total_amount'];  // Ensure this is calculated as needed
    
                    // Create a new booking record
                    Booking::query()->create([
                        'user_id' => Auth::id(),
                        'product_id' => $item['product_id'], // Assuming your session cart stores product_id
                        'numbers' => $item['numbers'], // Assuming your session cart stores numbers
                        'esewa_status' => 'payed',
                        'address' => auth()->user()->address, // Accessing user address
                        'phone' => auth()->user()->number, // Accessing user phone number
                        'price_per_item' => $item['price'], // Assuming your session cart stores price
                        'total_amount' => $data['total_amount'], // Use the total from payment data
                        'food_status' => 'ordered'
                    ]);
                }
    
                // Clear the session cart after payment
                session()->forget('cart'); // This will remove the cart data from the session
    
                // Return the success view with necessary data
                return view('restaurant-frontend.payment-success', [
                    'totalAmount' => $totalAmount,
                    'msg' => $msg
                ]);
            }
        }
    
        // Return failed payment view if payment is not complete or data is invalid
        return view('restaurant-frontend.payment-failed');
    }
    
}
