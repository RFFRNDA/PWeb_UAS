<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use App\Models\History;
use App\Models\Product;
use App\Models\Category;
use App\Models\TempImage;
use App\Models\SubCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HistoryController extends Controller
{
    public function store($id,Request $request) {
        // dd($request);
        
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


        } else {
           return response()->json([
            'status' => false,
            'errors' => $validator->errors()
           ]);
        }
    }


    public function update($id, Request $request) {

        $history = Product::find($id);

        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products,slug,'.$history->id.',id',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products,sku,'.$history->id.',id',
            // 'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ];

        // if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
        //     $rules['qty'] = 'required|numeric';
        // }

        $validator = Validator::make($request->all(),$rules);

        if($validator->passes()) {
            
            $history->prduct_id = $request->product;
            $history->title = $request->title;
            $history->slug = $request->slug;
            $history->description = $request->description;
            $history->price = $request->price;
            $history->compare_price = $request->compare_price;
            $history->sku = $request->sku;
            $history->barcode = $request->barcode;
            $history->track_qty = $request->track_qty;
            $history->qty = $request->qty;
            $history->status = $request->status;
            $history->category_id = $request->category;
            $history->sub_category_id = $request->sub_category;
            $history->brand_id = $request->brand;
            $history->is_featured = $request->is_featured;
            $history->save();
        }
    }
}
