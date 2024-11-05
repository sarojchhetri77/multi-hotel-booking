<?php
namespace App\Services;

use App\Models\Category;
use App\Models\Hotel;
use Illuminate\Support\Str;

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
        $category = $this->category->query();
        if(key_exists('status',$params)){
            $category->where('status',$params['status']);
        }
        if(key_exists('with',$params)){
            $category->with($params['with']);
        }
        return $category->get();

    }
    public function getCategoryById($id, $params = []){
        return $this->category->where('id',$id)->first();
      }

    public function requestCategory($data,$id = null){
        $data['slug'] = Str::slug($data['title'], '-');
       $category = $this->category->updateOrCreate(['id' => $id], $data);
       return $category;
    }
}