<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
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

    public function userSelectedRooms(Request $request,$slug){
        $selectedRooms = $request->session()->get('selected_rooms', []);
        // return $selectedRooms;
        $hotel = Hotel::where('slug',$slug)->first();
        return view('frontend.userrooms.index',compact('selectedRooms','hotel'));
    }

    public function removeRoom($roomId)
    {
        $selectedRooms = session()->get('selected_rooms', []);
    
        foreach ($selectedRooms as $key => $room) {
            if ($room['room_id'] == $roomId) {
                unset($selectedRooms[$key]);
                break; 
            }
        }
        session()->put('selected_rooms', $selectedRooms);
    
        return response()->json(['success' => true, 'roomId' => $roomId]);
    }
    

}
