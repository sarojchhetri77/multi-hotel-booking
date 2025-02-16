<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Room;
use App\Services\RoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoomsController extends Controller
{
    protected $roomService;
    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $hotel_id = Auth::user()->hotel->id;
        // $data['rooms'] = $this->roomService->listRooms(['hotel_id' =>$hotel_id]);
        $data['rooms'] = Room::where('hotel_id',$hotel_id)->get();
        return view('backend.rooms.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        $hotel_id = Auth::user()->hotel->id;
        $data['categories'] = Category::where('hotel_id',$hotel_id)->get();
        return view('backend.rooms.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','string','max:255'],
            'category_id' => ['required'],
            'thumbnail' => ['required','image','mimes:png,jpg,jpeg'],
            'capacity' => ['required'],
            'description' => ['required'],
            'room_number' => ['required'],
            'beds' => ['required'],
            'bed_type' => ['nullable'],
            'price_per_night' => ['required'],
            'has_wifi' => ['nullable'],
            'has_air_conditioning' => ['nullable'],
            'has_tv' => ['nullable'],
            'has_bathroom' => ['nullable'],
            'room_view' => ['nullable'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:png,jpg,jpeg'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->withInput()->with('error', 'Validation Error');
        }
        $store = $this->roomService->requestRoom($validator->valid());
        return redirect()->route('room.index')->with('success','Room created successfylly');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $data['room'] = $this->roomService->getRoomDetailsById($id);
        $hotel_id = Auth::user()->hotel->id;
        $data['category'] = Category::where('hotel_id',$hotel_id)->first();
        return view('backend.rooms.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
