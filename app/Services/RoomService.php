<?php
namespace App\Services;

use App\Models\Category;
use App\Models\Room;
use Illuminate\Support\Str;

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
    $data['slug'] = Str::slug($data['title'], '-');
    
   }
}