<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Services\CategoryService;
use App\Services\HotelService;
use Illuminate\Http\Request;

class HomesController extends Controller
{
    protected $categoryService;
    protected $hotelService;
    public function __construct(CategoryService $categoryService, HotelService $hotelService)
    {
        $this->categoryService = $categoryService;
        $this->hotelService = $hotelService;
    }
    public function index()
    {
        $data['categories'] = $this->categoryService->listCategories();
        $data['hotels'] = $this->hotelService->listHotels(['status' => config('constants.hotel_status.verified')]);
        return view('frontend.index', $data);
    }

    public function listHotels(Request $request)
    {
        $location = $request->query('location');
        $checkin = $request->query('check_in_date');
        $checkout = $request->query('check_out_date');
        $rooms = $request->query('rooms', 1); 
        if($rooms == 0){
            $rooms = 1;
        }
        $data['location'] = $location;
        $data['checkin'] = $checkin;
        $data['checkout'] = $checkout;
        $data['rooms'] = $rooms;
        $data['categories'] = $this->categoryService->listCategories();
      $hotelQuery = Hotel::query();
      $hotelQuery->where('status',config('constants.hotel_status.verified'));
        if ($location) {
            $hotelQuery = $hotelQuery->where(function ($query) use ($location) {
                $query->where('city', 'like', "%$location%")
                      ->orWhere('address', 'like', "%$location%");
            });
        }
        if ($rooms && is_numeric($rooms) && $rooms > 0) {
            $hotelQuery = $hotelQuery->where('room_number', '>=', $rooms);
        }
        $data['hotels'] = $hotelQuery->get();
        return view('frontend.booking.hotelList', $data);
    }
    
    
}
