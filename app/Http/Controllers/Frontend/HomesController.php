<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
        $data['location'] = $request->query('location');
        $data['checkin'] = $request->query('checkin');
        $data['checkout'] = $request->query('checkout');
        $data['adults'] = $request->query('adults', 1); // Default to 1 if not provided
        $data['children'] = $request->query('children', 0); // Default to 0 if not provided
        $data['rooms'] = $request->query('rooms', 1);
        $data['categories'] = $this->categoryService->listCategories();
        $data['hotels'] = $this->hotelService->listHotels(['status' => config('constants.hotel_status.verified')]);
        return view('frontend.booking.hotelList',$data);
    }
}
