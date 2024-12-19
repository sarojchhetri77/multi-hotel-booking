<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\HotelService;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    protected $hotelService;
   public function __construct(HotelService $hotelService)
   {
    $this->hotelService = $hotelService;
   }

    public function hotelDetail($slug){
        $data['hotel'] = $this->hotelService->getHotelDetailsBySlug($slug);
        return view("frontend.hotel.detail",$data);
    }
}
