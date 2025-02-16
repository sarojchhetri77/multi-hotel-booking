<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HotelServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $hotel = $user->hotel;
        $data['services'] = HotelService::where('hotel_id',$hotel->id)->get();
        return view('backend.hotelservice.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.hotelservice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','string','max:255'],
            'icon' => ['required','image','mimes:png,jpg,jpeg'],
            'short_description' => ['required'],
            'long_description' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->withInput()->with('error', 'Validation Error');
        }
        if ($request->hasFile('icon')) {
            $thumbnailPath = $request->file('icon')->store('hotel_service_images', 'public');
        }
    
        HotelService::create([
            'name' => $request->name,
            'icon' => $thumbnailPath ?? null,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'hotel_id' => Auth::user()->hotel->id,
        ]);
        return redirect()->route('hotelservice.index')->with('success','Hotel Service Added successfully');
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
        //
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
