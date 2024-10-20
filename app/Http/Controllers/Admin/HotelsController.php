<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Services\HotelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class HotelsController extends Controller
{
    protected $hotelService;
   public function __construct(HotelService $hotelService)
   {
      $this->hotelService = $hotelService;
   }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['hotels'] = $this->hotelService->listHotels();
        return view('backend.hotels.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.hotels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','string','max:50'],
            // 'owner_id' => ['required','exits:users,id'],
            'address' => ['required','string'],
            'district' => ['required','string'],
            'city' => ['required','string'],
            'room_number' => ['required','integer'],
            'street_no' => ['required','integer'],
        ]);
        if($validator->fails()){
            Log::error('Validation failed', ['errors' => $validator->errors()->all()]);
            return redirect()->back()->withErrors($validator->messages())->withInput()->with('error','Validation Error');
        }
        $this->hotelService->requestHotel($validator->valid());
        return redirect()->route('hotel.index')->with('success','Hotel is Created SUccessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['hotel'] = Hotel::findOrFail($id);
        return view('backend.hotels.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['hotel'] = $this->hotelService->getHotelDetailsById($id);
        return view('backend.hotels.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','string','max:50'],
            // 'owner_id' => ['required','exits:users,id'],
            'address' => ['required','string'],
            'district' => ['required','string'],
            'city' => ['required','string'],
            'total_room' => ['required','integer'],
            'street_num' => ['required','integer'],
        ]);
        if($validator->fails()){
            Log::error('Validation failed', ['errors' => $validator->errors()->all()]);
            return redirect()->back()->withErrors($validator->messages())->withInput()->with('error','Validation Error');
        }
        $this->hotelService->requestHotel($validator->valid(),$id);
        return redirect()->route('hotel.index')->with('success','Hotel Update SUccessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hotel = $this->findOrFail($id);
        if($hotel){
            $hotel->delete();
            return redirect()->route('hotel.index')->with('success','Hotel Update Successfully');
        }
        return redirect()->route('hotel.index')->with('error','Delete failed!');
    }

    public function updateHotelStatus(Hotel $hotel, $action)
    {
        switch ($action) {
            case 'verified':
                return $this->updateStatus($hotel, 'verified');
            case 'rejected':
                return $this->updateStatus($hotel, 'rejected');
            default:
                return redirect()->route('hotel.index')->with('error', 'Invalid action');
        }
    }
    
    protected function updateStatus($hotel, $status)
    {
        $hotel->status = $status;
        if ($hotel->save()) {
            return redirect()->route('hotel.index')->with('success', 'Status updated successfully');
        }
    
        return redirect()->route('hotel.index')->with('error', 'Failed to update status');
    }
    

    public function updateRejectMessage(Request $request,$id){
        $validator = Validator::make($request->all(),[
           'reason' => ['required'],
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }
        $hotel = Hotel::findOrFail($id);
        $hotel->reject_message = $request->reason;
        $hotel->status = config('constants.hotel_status.rejected');
        $hotel->save();
        return redirect()->route('hotel.index')->with('success','Hotel Reject Successfully');

    }

}
