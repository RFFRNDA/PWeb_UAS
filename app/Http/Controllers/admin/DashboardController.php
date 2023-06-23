<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $categoryCount = Category::count();
        $brandsCount = Brand::count();
        $productCount = Product::count();
        
        $result = ['category_count'=>$categoryCount,'brands_count'=>$brandsCount,'product_count'=>$productCount] ;
        
        return view('admin.dashboard', $result, );
        
    }
}
