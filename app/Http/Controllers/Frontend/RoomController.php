<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\HotelService;
use App\Services\RoomService;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomService;
    protected $hotelService;
    public function __construct(RoomService $roomService,HotelService $hotelService)
    {
        $this->roomService = $roomService;
        $this->hotelService = $hotelService;
    }


    public function index($slug){
      $data['hotel'] = $this->hotelService->getHotelRoomBySlug($slug);
      return view('frontend.room.index',$data);
    }

    public function roomDetails($id){
        $room = $this->roomService->getRoomDetailsById($id,['with'=>['images']]);
        $data['hotel'] = $room->hotel;
        $data['room'] = $room;
        return view('frontend.room.details',$data);
    }

    public function storeSelectedRooms(Request $request)
    {
        $newSelectedRooms = $request->input('selected_rooms', []);
    
        // Retrieve existing rooms from session
        $existingRooms = session('selected_rooms', []);
    
        // Merge new rooms with existing ones, ensuring no duplicates
        foreach ($newSelectedRooms as $newRoom) {
            if (!collect($existingRooms)->contains('room_id', $newRoom['room_id'])) {
                $existingRooms[] = $newRoom;
            }
        }
    
        // Store the updated list back into the session
        session(['selected_rooms' => $existingRooms]);
    
        return response()->json(['status' => 'success', 'selected_rooms' => $existingRooms]);
    }
    
}
