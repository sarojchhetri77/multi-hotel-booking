<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\HotelService;
use Illuminate\Http\Request;

class HomesController extends Controller
{ 
    protected $categoryService;
    protected $hotelService;
    public function __construct(CategoryService $categoryService,HotelService $hotelService)
    {
        $this->categoryService = $categoryService;
        $this->hotelService = $hotelService;
    }
    public function index(){
       $data['categories'] = $this->categoryService->listCategories();
       $data['hotels'] = $this->hotelService->listHotels(['status'=>config('constants.hotel_status.verified')]);
       return view('index',$data);
    }
}
