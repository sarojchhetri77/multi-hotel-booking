<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RoomService
{
    protected $room;
    protected $category;
    protected $roomImage;
    public function __construct(Room $room, Category $category,RoomImage $roomImage)
    {
        $this->room = $room;
        $this->category = $category;
        $this->roomImage = $roomImage;
    }

    public function listRooms($params = [])
    {
        $rooms = $this->room->query();
        if (key_exists('status', $params)) {
            $rooms->where('status', $params['status']);
        }
        if (key_exists('with', $params)) {
            $rooms->with($params['with']);
        }
        return $rooms->get();
    }

    public function requestRoom($data = [], $id = null)
    {
        $data['slug'] = Str::slug($data['name'], '-');
        $data['hotel_id'] = Auth::user()->hotel->id;
        if (key_exists('thumbnail', $data)) {
            if ($data['thumbnail'] instanceof UploadedFile) {
                $thumbnailPath = $data['thumbnail']->store('uploads/rooms/thumbnails', 'public');
                $thumbnailPath = Storage::url($thumbnailPath);
                $data['thumbnail'] = $thumbnailPath;
            } else {
                unset($data['thumbnail']);
            }
        }

        $room = $this->room->updateOrCreate(['id' => $id], $data);

        if (isset($data['images'])) {
            $image = $this->roomImage->where('room_id',$room->id)->delete();
            foreach ($data['images'] as $image) {
                if ($image instanceof UploadedFile) {
                    $path = $image->store('uploads/room/images', 'public');
                    $this->roomImage::create([
                        'room_id' => $room->id ?? $id,
                        'url' => Storage::url($path)
                    ]);
                }
            }
        }
        return $room;
    }

    public function getRoomDetailsById($id, $params = [])
    {
        $room = $this->room->query();
        if (key_exists('status', $params)) {
            $room->where('status', $params['status']);
        }
        if (key_exists('with', $params)) {
            $room->with($params['with']);
        }
        return $room->where('id', $id)->first();
    }
    public function getRoomDetailsBySlug($slug, $params = [])
    {
        $room = $this->room->query();
        if (key_exists('status', $params)) {
            $room->where('status', $params['status']);
        }
        if (key_exists('with', $params)) {
            $room->with($params['with']);
        }
        return $room->where('slug', $slug)->first();
    }
}
