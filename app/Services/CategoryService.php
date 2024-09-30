<?php
namespace App\Services;

use App\Models\Category;
use App\Models\Hotel;

class CategoryService
{   
   protected $hotel;
   protected $category;
    public function __construct(Hotel $hotel, Category $category)
    {
        $this->hotel = $hotel;
        $this->category = $category;
    }

    public function listCategories($params = []){

    }

    public function requestCategory($data,$id = null){
        
    }
}