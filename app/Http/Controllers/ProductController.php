<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    public function index()
    {
        
        return view('admin.add_prudact');
   
    }

    public function save_product(Request $request)
    {
        $data   = array();
        $data  ['product_id']                   = $request->product_id;
        $data  ['product_name']                 = $request->product_name;
        $data  ['category_id']                  = $request->category_id ;
        $data  ['manufacture_id']               = $request->manufacture_id ;
        $data  ['product_short_description']    = $request->product_short_description;
        $data  ['product_long_description']     = $request->product_long_description;
        $data  ['product_price']                = $request->product_price;
        $data  ['product_size']                 = $request->product_size;
        $data  ['product_color']                = $request->product_color;
        $data  ['publications_status']          = $request->publications_status;
        $data  ['created_at']                   =  Carbon::now('Asia/jakarta');
        $image = $request->file('product_image');
        if ($image) {
            $image_name      = str_random(20);
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path     ='image/';
            $image_url       = $upload_path.$image_full_name;
            $success         = $image->move($upload_path,$image_full_name);
            if ($success) {
                    $data['product_image'] = $image_url;
                    DB::table('tbl_products')->insert($data);
                    Session::put('message','Product added Successfuly !!');
                    return Redirect::to('/add_product');
                 }
            }
        $data['product_image'] = '';    
        DB::table('tbl_products')->insert($data);
        Session::put('message','Product added Successfuly !!');
        return Redirect::to('/add_product');
      
      }

      public function all_product()
      {
        $data = DB::table('tbl_products')
        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
        ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
        ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
        ->get(); 
         return view('admin/all_products', ['data' => $data]);
      }
      
    public function unactive_product($product_id)
    {
        DB::table('tbl_products')
        ->where('product_id', $product_id)
        ->update(['publications_status' => 0 ]);   
        Session::put('message','category Unactive Successfuly !!');      
        return Redirect::to('/all_product');
    }
          
    public function active_product($product_id)
    {
        DB::table('tbl_products')
        ->where('product_id', $product_id)
        ->update(['publications_status' => 1 ]);   
        Session::put('message','product Unactive Successfuly !!');      
        return Redirect::to('/all_product');
    }

    public function edit_product($product_id)
    {
         $data = DB::table('tbl_products')
        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
        ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
        ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
        ->where('tbl_products.product_id',$product_id)
        ->first();
         return view('admin.edit_product')->with('data', $data);
    }

    public function update_product(Request $request, $product_id)
    {
        $data   = array();
        $data  ['product_name']                 = $request->product_name;
        $data  ['category_id']                  = $request->category_id ;
        $data  ['manufacture_id']               = $request->manufacture_id ;
        $data  ['product_short_description']    = $request->product_short_description;
        $data  ['product_long_description']     = $request->product_long_description;
        $data  ['product_price']                = $request->product_price;
        $data  ['product_size']                 = $request->product_size;
        $data  ['product_color']                = $request->product_color;
        $data  ['publications_status']          = $request->publications_status;
        $data  ['created_at']                   =  Carbon::now('Asia/jakarta');
        if ($request->hasFile('product_image'))
            {
                $file = $request->file('product_image');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString()); 
                $name = $timestamp. '-' .$file->getClientOriginalName();
                $data->image = $name;
                $file->move(public_path().'/image/', $name);                       
        }  
         $data['product_image'] = '';  
         $data = DB::table('tbl_products')
                    ->where('product_id',$product_id) 
                    ->update($data);
        Session::put('message','Product Update Successfuly !!');
        return Redirect::to('/all_product');

    }
    public function delete_product($product_id)
    {
        DB::table('tbl_products')
        ->where('product_id', $product_id)
        ->delete();
        Session::put('message','category Delete Successfuly !!'); 
        return Redirect::to('/all_product');
    }
}
