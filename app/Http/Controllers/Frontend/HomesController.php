<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
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

        if ($rooms == 0) {
            $rooms = 1;
        }
        if (!empty($checkin) && !empty($checkout)) {
            session([
                'checkin' => $checkin,
                'checkout' => $checkout
            ]);
        } else {
            $checkin = session('checkin');
            $checkout = session('checkout');
        }

        $data['location'] = $location;
        $data['checkin'] = $checkin;
        $data['checkout'] = $checkout;
        $data['rooms'] = $rooms;
        $data['categories'] = $this->categoryService->listCategories();

        $hotelQuery = Hotel::query();
        $hotelQuery->where('status', config('constants.hotel_status.verified'));

        if ($location) {
            $hotelQuery = $hotelQuery->where(function ($query) use ($location) {
                $query->where('city', 'like', "%$location%")
                    ->orWhere('address', 'like', "%$location%");
            });
        }

        if ($rooms && is_numeric($rooms) && $rooms > 0) {
            $hotelQuery = $hotelQuery->where('room_number', '>=', $rooms);
        }
        if ($checkin && $checkout) {
            $hotelQuery->where(function ($query) use ($checkin, $checkout, $rooms) {
                $query->whereRaw("room_number - (SELECT COUNT(*) FROM bookings WHERE hotel_id = hotels.id AND (
                    (check_in_date BETWEEN ? AND ?) OR 
                    (check_out_date BETWEEN ? AND ?) OR 
                    (check_in_date < ? AND check_out_date > ?)
                )) >= ?", [$checkin, $checkout, $checkin, $checkout, $checkin, $checkout, $rooms]);
            });
        }

        // Get the filtered hotels
        $data['hotels'] = $hotelQuery->get();

        return view('frontend.booking.hotelList', $data);
    }


    public function getAvailableRooms($hotelId, $checkin, $checkout)
    {
        // Get the hotel by ID
        $hotel = Hotel::findOrFail($hotelId);

        // Calculate the number of booked rooms during the date range
        $bookedRooms = Booking::where('hotel_id', $hotelId)
            ->where(function ($query) use ($checkin, $checkout) {
                $query->whereBetween('check_in_date', [$checkin, $checkout])
                    ->orWhereBetween('check_out_date', [$checkin, $checkout])
                    ->orWhere(function ($query) use ($checkin, $checkout) {
                        $query->where('check_in_date', '<', $checkin)
                            ->where('check_out_date', '>', $checkout);
                    });
            })
            ->count();

        // Calculate available rooms
        $availableRooms = $hotel->room_number - $bookedRooms;

        return $availableRooms;
    }
}
