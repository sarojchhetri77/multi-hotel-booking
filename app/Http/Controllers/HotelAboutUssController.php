<?php

namespace App\Http\Controllers;

use App\Models\HotelAboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HotelAboutUssController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutUs = HotelAboutUs::where('hotel_id', auth()->user()->hotel->id)->first();
        return view('backend.hotelaboutus.index', compact('aboutUs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.hotelaboutus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Store method started.');

    $request->validate([
        'small_description' => 'required|string|max:500',
        'long_description' => 'required|string',
        'num_clients' => 'required|integer|min:0',
        'num_staff' => 'required|integer|min:0',
        'num_rooms' => 'required|integer|min:0',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    Log::info('Validation passed.', $request->all());

    $images = [];
    if ($request->hasFile('images')) {
        Log::info('Files detected in request.');

        foreach ($request->file('images') as $image) {
            $path = $image->store('about_us', 'public');
            Log::info('Image stored at: ' . $path);
            $images[] = $path;
        }
    } else {
        Log::info('No images found in request.');
    }

    $hotelId = auth()->user()->hotel->id ?? null;
    Log::info('Hotel ID: ' . ($hotelId ?? 'Not found'));

    if (!$hotelId) {
        Log::error('Hotel ID is null. User might not be associated with a hotel.');
        return redirect()->back()->withErrors(['error' => 'No hotel found for this user.']);
    }

    $aboutUs = HotelAboutUs::updateOrCreate(
        ['hotel_id' => $hotelId],
        [
            'title' => $request->title,
            'small_description' => $request->small_description,
            'long_description' => $request->long_description,
            'num_clients' => $request->num_clients,
            'num_staff' => $request->num_staff,
            'num_rooms' => $request->num_rooms,
            'images' => json_encode($images),
        ]
    );

    Log::info('About Us record updated/created successfully.', ['hotel_id' => $hotelId, 'about_us_id' => $aboutUs->id]);

    return redirect()->route('hotelaboutus.index')->with('success', 'About Us updated successfully.');
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
        $aboutUs = HotelAboutUs::where('hotel_id', auth()->user()->hotel->id)->first();
        return view('backend.hotelaboutus.edit', compact('aboutUs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->store($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aboutUs = HotelAboutUs::where('hotel_id', auth()->user()->hotel->id)->first();
        if ($aboutUs) {
            $aboutUs->delete();
        }
        return redirect()->route('backend.hotelaboutus.index')->with('success', 'About Us deleted successfully.');
    }
}
