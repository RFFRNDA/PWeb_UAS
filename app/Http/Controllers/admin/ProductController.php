<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\TempImage;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::latest('id')->with('product_images');

        if ($request->get('keyword') != "") {
            $products = $products->where('title','like','%'.$request->keyword.'%');
        }

        $products = $products->paginate();
        
        $data['products'] = $products;
        return view('admin.products.list',$data);
    }

    public function create() {
        $data = [];
        $categories = Category::orderBy('name','ASC')->get();
        $brands = Brand::orderBy('name','ASC')->get();
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        return view('admin.products.create', $data);
    }

    public function store(Request $request) {
      
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products',
            // 'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ];

        // if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
        //     $rules['qty'] = 'required|numeric';
        // }

        $validator = Validator::make($request->all(),$rules);

        if($validator->passes()) {
            
            $product = new Product();
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->save();


            // Save Gallery Pics\
            if(!empty($request->image_array)) {
                foreach($request->image_array as $temp_image_id) {

                    $tempImageInfo = TempImage::find($temp_image_id);
                    $extArray = explode('.',$tempImageInfo->name);
                    $ext = last($extArray); 

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'NULL';
                    $productImage->save();

                    $imageName = $product->id.'-'.$productImage->id.'-'.time().'.'.$ext;
                    $productImage->image = $imageName;
                    $productImage->save();

                    // Generate Product Thumbnalis

                    // Large Image
                    $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
                    $destPath = public_path().'/uploads/product/large/'.$imageName;
                    $image = Image::make($sourcePath);
                    $image->resize(1400, null, function($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->save($destPath);

                    // Small Image
                    $destPath = public_path().'/uploads/product/small/'.$imageName;
                    $image = Image::make($sourcePath);
                    $image->fit(300, 300);
                    $image->save($destPath);
                }
            }

            Session::flash('success','Product added successfully');
         
            return response()->json([
                'status' => true,
                'message' => 'Product added successfully'
               ]);

        } else {
           return response()->json([
            'status' => false,
            'errors' => $validator->errors()
           ]);
        }
    }

    public function edit($id, Request $request) 
    {
        $product = Product::find($id);

        $subCategories = SubCategory::where('category_id',$product->category_id)->get();

        $data = [];
        $data['product'] = $product;
        $data['subCategories'] = $subCategories;
        $categories = Category::orderBy('name','ASC')->get();
        $brands = Brand::orderBy('name','ASC')->get();
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        return view('admin.products.edit',$data);
    }

    public function update($id, Request $request) {
        
        $product = Product::find($id);
        
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products,slug,'.$product->id.',id',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products,sku,'.$product->id.',id',
            // 'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ];
        
        // if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
            //     $rules['qty'] = 'required|numeric';
            // }
            
            $validator = Validator::make($request->all(),$rules);
            
            if($validator->passes()) {
                
                $history = new History();
                $history->product_id = $id;
                $history->title_bfr = $request->title;
                $history->slug_bfr = $request->slug;
                $history->description_bfr = $request->description;
                $history->price_bfr = $request->price;
                $history->compare_price_bfr = $request->compare_price;
                $history->sku_bfr = $request->sku;
                $history->barcode_bfr = $request->barcode;
                $history->qty_bfr = $request->qty;
                $history->status_bfr = $request->status;
                $history->category_id_bfr = $request->category;
                $history->sub_category_id_bfr = $request->sub_category;
                $history->brand_id_bfr = $request->brand;
                $history->is_featured_bfr = $request->is_featured;
                $history->save();

            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->save();


            // Save Gallery Pics\
            Session::flash('success','Product updated successfully');
         
            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully'
               ]);

        } else {
           return response()->json([
            'status' => false,
            'errors' => $validator->errors()
           ]);
        }
    }

    public function destroy($productId, Request $request) {
        $product = Product::find($productId);

        if (empty($product)) {  
            Session::flash('error','product not found');       
            return response()->json([
                'status' => true,
                'message' =>  'product not found'
            ]);
        }

        File::delete(public_path().'/uploads/product/thumb/'.$product->image);
        File::delete(public_path().'/uploads/product/'.$product->image);

        $product->delete();

        Session::flash('success','product deleted successfully');

        return response()->json([
            'status' => true,
            'message' =>  'product deleted successfully'
        ]);
    }


  

}
