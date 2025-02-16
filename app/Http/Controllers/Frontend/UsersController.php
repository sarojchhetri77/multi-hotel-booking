<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(){
        $data['bookings'] = Booking::where('user_id',Auth::id())->get();
        return view('frontend.users.dashboard',$data);
    }
}
