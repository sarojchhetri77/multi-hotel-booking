<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\HotelService;
use App\Services\RoomService;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    protected $hotelService;
    protected $roomService;
   public function __construct(HotelService $hotelService,RoomService $roomService)
   {
    $this->hotelService = $hotelService;
    $this->roomService = $roomService;
   }

    public function hotelDetail($slug){
        $data['hotel'] = $this->hotelService->getHotelDetailsBySlug($slug);
        return view("frontend.hotel.detail",$data);
    }


    public function roomDetail($hotelSlug,$slug){
        $data['room'] = $this->roomService->getRoomDetailsById($slug,['with'=>'hotel']);
        return view('frontend.room.index',$data);
    }

    public function userSelectedRooms(){
        return view('frontend.userrooms.index');
    }
}
