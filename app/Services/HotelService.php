<?php
namespace App\Services;

use App\Models\Hotel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HotelService
{
    protected $hotel;
    public function __construct(Hotel $hotel)
    {
        $this->hotel = $hotel;
    }

    public function listHotels($params= []){
        $hotels = $this->hotel->query();
        if(key_exists('status',$params)){
            $hotels->where('status',$params['status']);
        }
        if(key_exists('is_feature',$params)){
            $hotels->where('is_feature',$params['is_feature']);
        }
        if(key_exists('with',$params)){
            $hotels->with($params['with']);
        }
        return $hotels->latest()->get();

    }
    
    public function requestHotel($data, $id = null){
        $data['slug'] = Str::slug($data['name']) . '-' . now()->timestamp;
        $data['owner_id'] = Auth::user()->id;
        if(key_exists('thumbnail',$data)){
            if($data['thumbnail'] instanceof UploadedFile){
                $thumbnailPath = $data['thumbnail']->store('uploads/hotels/thumbnails','public');
                $thumbnailPath = Storage::url($thumbnailPath);
                $data['thumbnail'] = $thumbnailPath;
            } 
            else{
                unset($data['thumbnail']);
            }
        }

        $hotel = $this->hotel->updateOrCreate(['id' => $id],$data);
        return $hotel;
    }

    public function getHotelDetailsById($id,$params = []){
        $hotel = $this->hotel->query();
        if(key_exists('status',$params)){
            $hotel->where('status',$params['status']);
        }
        if(key_exists('with',$params)){
            $hotel->with($params['with']);
        }
        return $hotel->where('id',$id)->first();
    }


    public function getHotelDetailsBySlug($slug,$params = []){
        $hotel = $this->hotel->query();
        if(key_exists('status',$params)){
            $hotel->where('status',$params['status']);
        }
        if(key_exists('with',$params)){
            $hotel->with($params['with']);
        }
        return $hotel->where('slug',$slug)->first();
    }

    public function getHotelRoomBySlug($slug,$params=[]){
        $hotel = $this->hotel->where('slug',$slug)->with('rooms')->first();
        return $hotel;
    
    }


}