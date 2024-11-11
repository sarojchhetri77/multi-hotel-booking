<?php
namespace App\Services;

use App\Models\Category;
use App\Models\Room;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RoomService
{
    protected $room;
    protected $category;
   public function __construct(Room $room,Category $category)
   {
     $this->room = $room;
     $this->category = $category;
   }

   public function listRooms($params = []){
    $rooms = $this->room->query();
    if(key_exists('status',$params)){
        $rooms->where('status',$params['status']);
    }
    if(key_exists('with',$params)){
        $rooms->with($params['with']);
    }
    return $rooms->get();
   }

   public function requestRoom($data=[],$id = null){
    $data['slug'] = Str::slug($data['name'], '-');
    $data['hotel_id'] = Auth::user()->hotel->id;
    if(key_exists('thumbnail',$data)){
        if($data['thumbnail'] instanceof UploadedFile){
            $thumbnailPath = $data['thumbnail']->store('uploads/rooms/thumbnails','public');
            $thumbnailPath = Storage::url($thumbnailPath);
            $data['thumbnail'] = $thumbnailPath;
        } 
        else{
            unset($data['thumbnail']);
        }
    }

    $room = $this->room->updateOrCreate(['id' => $id],$data);
    return $room;
    
   }

   public function getRoomDetailsById($id,$params = []){   
    return $this->room->where('id',$id)->first();
}
}