<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\RoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $data['rooms'] = $this->roomService->listRooms(['hotel_id' =>$hotel_id]);
        return view('backend.rooms.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        $hotel_id = Auth::user()->hotel->id;
        $data['category'] = Category::where('hotel_id',$hotel_id)->first();
        return view('backend.rooms.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
