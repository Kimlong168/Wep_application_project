<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Session;
use Validator;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $num=0;
        $products = Product::all()->sortBy('category_id');
        $categories = Category::all()->pluck('name', 'id');
  
        return view('product.index')
        ->with('products',$products)
        ->with('categories',$categories)
        ->with('num',$num);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = array();
    	foreach (Category::all() as $category) {
    		$categories[$category->id] = $category->name;
    	}
    	return view('product.create')->with('categories', $categories);

        // return view('product.create',[
        //     'categories' => $categories,
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20|min:3',
            'category_id' => 'required|integer',
            'price' => 'required|max:20|min:3',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'description' => 'required|max:1000|min:10',
        ]);
          
        if ($validator->fails()) {
            return redirect('product/create')
                ->withInput()
                ->withErrors($validator);
        }
    
        // Create The product
        $image = $request->file('image');
        $upload = 'assets/';
        $filename = time().$image->getClientOriginalName();
        move_uploaded_file($image->getPathName(), $upload. $filename);
    
        $product = new Product();
        $product->name = $request->name;
	    $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->image = $filename;
        $product->description = $request->description;
        $product->save();
        Session::flash('product_create','New data is created.');
        return redirect('product/create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = array();
    	foreach (Category::all() as $category) {
    		$categories[$category->id] = $category->name;
    	}
        $product = Product::findOrFail($id);
    	return view('product.show')->with('product', $product)->with('categories', $categories);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
	    $categories = array();
        foreach (Category::all() as $category) {
            $categories[$category->id] = $category->name;
        }
        $product = Product::findOrFail($id);
        return view('product.edit')->with('product', $product)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validator = Validator::make($request->all(), [
			'name' => 'required|max:20|min:3',
			'price' => 'required|max:20|min:3',
			'image' => 'mimes:jpg,jpeg,png,gif',
			'description' => 'required|max:1000|min:10',
		]);

		if ($validator->fails()) {
			return redirect('product/'.$id.'/edit')
				->withInput()
				->withErrors($validator);
		}
        $product = Product::find($id);
		// Create The Post
		if($request->file('image') != ""){
            $image = $request->file('image');
            $upload = 'assets/';
            $filename = time().$image->getClientOriginalName();
            move_uploaded_file($image->getPathName(), $upload . $filename);
		}
		
		$product->name = $request->Input('name');
		$product->price = $request->Input('price');
		if(isset($filename)){
		    $product->image = $filename;
		}
        $product->category_id = $request->Input('category_id');
		$product->description = $request->Input('description');
		$product->save();

		Session::flash('product_update','Data is updated ('.$product->name.')');
		return redirect('product/'.$product->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $product = Product::find($id);
    	$image_path = 'assets/'.$product->image;
    	File::delete($image_path);
    	$product->delete();
    	Session::flash('product_delete','Data is deleted ('.$product->name.')');
    	return redirect('product');
    }

    public function getBySearch(Request $request) {
        $keyword = !empty($request->input('keyword'))?$request->input('keyword'):"";
        // $categories = Category::all();
        $categories = Category::all()->pluck('name', 'id');

        if(is_numeric($keyword)){
            $searchKeyword='price';
            $products = Product::where($searchKeyword, '=', $keyword)->get();
        }else{
            $searchKeyword='name';
            $products = Product::where($searchKeyword, 'LIKE', '%'.$keyword.'%')->get();
        }
        
        if( $keyword != ""){
            return view('product.index')
                ->with('products', $products)
                ->with('categories', $categories)
                ->with('num',0);
        } else {
            return view('product.index')
                ->with('products', Product::all())
                ->with('keyword', $keyword)
                ->with('categories', $categories)
                ->with('num',0);
        } 
    }


    public function filterByCategory(Request $request){
        
        $id = $request->Input('category_id');
        // $id = $request->category_id; //the same as above statement

        $products = Product::where('category_id', '=', $id)->get();
        $categories = Category::all()->pluck('name', 'id');
    
        return view('product.index')
        ->with('products',$products)
        ->with('categories',$categories)
        ->with('num',0);
        
    }

    //sort by product's name and price

    public function sortProduct(Request $request){
        $sortItem = $request->input('sortItem');

        $products = Product::orderBy($sortItem,'asc')->get();
        $categories = Category::all()->pluck('name', 'id');
        
        return view('product.index')
        ->with('products',$products)
        ->with('categories',$categories)
        ->with('num',0);
    }
}
