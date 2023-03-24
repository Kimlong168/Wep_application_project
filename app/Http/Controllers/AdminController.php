<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function index(){
        $categories = Category::all()->sortBy('id');
        $products = Product::all()->sortBy('price');
    	return view('admin.index')->with('products', $products)->with('categories', $categories);
    }

    public function dashboard(){
        $count1 = Product::count();
        $count2 = Category::count();
        return view('admin.dashboard')->with('count1',$count1)->with('count2',$count2);
    }

}
