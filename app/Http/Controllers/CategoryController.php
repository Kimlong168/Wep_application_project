<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Session;
use Validator;
use File;


class CategoryController extends Controller
{

    public function index() {
        $num=0;
        $categories = Category::all();
        return view('category.index')->with('categories', $categories)->with('num',$num);
    }

    public function create(){
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        
        // Create The Category
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        Session::flash('category_create','Category is created.');
        return redirect('/category/create');
    }

    public function show($id){
        $category= Category::find($id);
        return view('category.show')->with('category', $category);
    }
    
    public function destroy($id) {
    	$categories = Category::find($id);
    	$categories->delete();
    	Session::flash('category_delete','Category is deleted.');

        // $products = Product::where('category_id','=',$id);
        // $products->delete();
        
        return redirect('/category');
    }


    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit')->with('category', $category);
    }

    public function update(Request $request, $id)
    {
                $validator = Validator::make($request->all(), [
			'name' => 'required|max:20|min:3',
            'description' => 'required|max:50|min:3',
		]);
		if ($validator->fails()) {
			return redirect('category/' . $id . '/edit')
            ->withInput()
            ->withErrors($validator);
		}
		// Create The Category
		$category = Category::find($id);
		$category->name = $request->Input('name');
        $category->description = $request->Input('description');
		$category->save();
		Session::flash('category_update','Category is updated.');
		return redirect('category/' . $id . '/edit');
    }

    public function getBySearch(Request $request) {

        $keyword = !empty($request->input('keyword'))?$request->input('keyword'):"";
  
        if( $keyword != ""){
            return view('category.index')
                ->with('categories', Category::where('name', 'LIKE', '%'.$keyword.'%')->paginate())
                ->with('num',0);
        } else {
            return view('category.index')
                ->with('categories', Category::all())
                ->with('num',0);
        } 
    }
}

