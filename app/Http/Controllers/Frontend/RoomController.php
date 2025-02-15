<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Services\HotelService;
use App\Services\RoomService;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomService;
    protected $hotelService;
    public function __construct(RoomService $roomService, HotelService $hotelService)
    {
        $this->roomService = $roomService;
        $this->hotelService = $hotelService;
    }


    public function index(Request $request, $slug)
    {
        $checkin = $request->query('check_in_date');
        $checkout = $request->query('check_out_date');
        $hotel = $this->hotelService->getHotelRoomBySlug($slug);
        $availableRooms = $this->getAvailableRooms($hotel->id, $checkin, $checkout);
        $data['hotel'] = $hotel;
        $data['rooms'] = $availableRooms;
        $data['checkin'] = $checkin;
        $data['checkout'] = $checkout;

        return view('frontend.room.index', $data);
    }


    public function roomDetails($id)
    {
        $room = $this->roomService->getRoomDetailsById($id, ['with' => ['images']]);
        $data['hotel'] = $room->hotel;
        $data['room'] = $room;
        return view('frontend.room.details', $data);
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

    public function getAvailableRooms($hotelId, $checkin = null, $checkout = null)
    {
        $roomsQuery = Room::where('hotel_id', $hotelId);
        if ($checkin && $checkout) {
            $bookedRoomIds = Booking::where('hotel_id', $hotelId)
                ->where(function ($query) use ($checkin, $checkout) {
                    $query->whereBetween('check_in_date', [$checkin, $checkout])
                        ->orWhereBetween('check_out_date', [$checkin, $checkout])
                        ->orWhere(function ($query) use ($checkin, $checkout) {
                            $query->where('check_in_date', '<', $checkin)
                                ->where('check_out_date', '>', $checkout);
                        });
                })
                ->pluck('room_id')
                ->toArray();
            $roomsQuery->whereNotIn('id', $bookedRoomIds);
        }
        return $roomsQuery->get();
    }
}
