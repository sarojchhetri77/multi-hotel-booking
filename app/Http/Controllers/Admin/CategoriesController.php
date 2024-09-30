<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;        
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['category'] = $this->categoryService->listCategories();
        return view('backend.category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => ['required','string'],
            'hotel_id' => ['required','exits:hotels,id'],
            // 'thumbnail' => ['nullable'],
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->messages())->withInput()->with('error','Validation Error');
        }
        $this->categoryService->requestCategory($validator->valid());
        return redirect()->route('category.index')->with('success','Category Create Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['category'] = Category::findOrFail($id);
        return view('backend.category.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['category'] = Category::findOrFail($id);
        return view('backend.category.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => ['required','string'],
            'hotel_id' => ['required','exits:hotels,id'],
            // 'thumbnail' => ['nullable'],
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->messages())->withInput()->with('error','Validation Error');
        }
        $this->categoryService->requestCategory($validator->valid(),$id);
        return redirect()->route('category.index')->with('success','Category Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        if($category){
            $category->delete();
            return redirect()->route('category.index')->with('success','Category delete Sucessfully');
        }
        return redirect()->route('category.index')->with('error','Delete failed');
    }
}
