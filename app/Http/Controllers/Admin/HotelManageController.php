<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelManageController extends Controller
{
    // to show the dashboard of the hotel
    public function index()
    {
        $user = Auth::user();
        if (!$user->hotel || in_array($user->hotel->status, [config('constants.hotel_status.rejected'), config('constants.hotel_status.unverified')])) {
            abort(404);
        }
        $data['hotel'] = $user->hotel;
        return view('backend.manage_hotel.dashboard', $data);
    }
}
