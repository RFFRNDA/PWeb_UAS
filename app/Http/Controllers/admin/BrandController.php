<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function index(Request $request) {
        $brands = Brand::latest('id');

        if ($request->get('keyword')) {
            $brands = $brands->where('name','like','%'.$request->keyword.'%');
            // $brands = $brands->orwhere('categories.name','like','%'.$request->get('keyword').'%');
        }

        $brands = $brands->Paginate(10);

        return view('admin.brands.list',compact('brands'));

    }

    public function create() {
      return view('admin.brands.create');  
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:brands',
        ]);

        if ($validator->passes()) {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            return response()->json([
                'status' => true,
                'message' => 'Brand added successfully'
            ]);
            
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
           ]);
        }
    }

    public function edit($id, Request $request) {
        $brand = Brand::find($id);

        if (empty($brand)) {
            Session::flash('error','Record not found !');
            return redirect()->route('brands.index');
        }

        $data['brand'] = $brand;

        return view('admin.brands.edit',$data);

    }

    public function update($id, Request $request) {
        
        $brand = Brand::find($id);

        if (empty($brand)) {
            Session::flash('error','Record not found !');

            return response()->jsin([
                'status' => false,
                'notFound' => true
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$brand->id.',id',
        ]);

        if ($validator->passes()) {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            return response()->json([
                'status' => true,
                'message' => 'Brand added successfully'
            ]);
            
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
           ]);
        }
    }

    public function destroy($id, Request $request) {
        $brand = Brand::find($id);

        if (empty($brand)) {  
            Session::flash('error','Brand not found');       
            return response()->json([
                'status' => true,
                'message' =>  'Category not found'
            ]);
        }

        $brand->delete();

        Session::flash('success','Brand deleted successfully');

        return response()->json([
            'status' => true,
            'message' =>  'Brand deleted successfully'
        ]);
    }
}
