<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.add_slide');
    }


        public function save_slide(Request $request)
        {
            $data   = array();
            $data  ['slider_id']                   = $request->slider_id;
            $image = $request->file('slider_image');
            $data  ['publications_status']          = $request->publications_status;
            $data  ['created_at']                   =  Carbon::now('Asia/jakarta');
            if ($image) {
                $image_name      = str_random(20);
                $ext             = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path     ='image/';
                $image_url       = $upload_path.$image_full_name;
                $success         = $image->move($upload_path,$image_full_name);
                if ($success) {
                        $data['slider_image'] = $image_url;
                        DB::table('tbl_slider')->insert($data);
                        Session::put('message','Product added Successfuly !!');
                        return Redirect::to('/add_slide');
                        }
                }
            $data['slider_image'] = '';    
            DB::table('tbl_slider')->insert($data);
            Session::put('message','Product added Successfuly !!');
            return Redirect::to('/add_slide');
            
            }

            public function all_slide()
            {
            $data = DB::table('tbl_slider')->get(); 
                return view('admin/all_slide', ['data' => $data]);
            }
            
        public function unactive_slide($slider_id)
        {
            DB::table('tbl_slider')
            ->where('slider_id', $slider_id)
            ->update(['publications_status' => 0 ]);   
            Session::put('message','Slider Unactive Successfuly !!');      
            return Redirect::to('/all_slide');
        }
                
        public function active_slide($slider_id)
        {
            DB::table('tbl_slider')
            ->where('slider_id', $slider_id)
            ->update(['publications_status' => 1 ]);   
            Session::put('message','Slider Unactive Successfuly !!');      
            return Redirect::to('/all_slide');
        }

        public function edit_slide($slider_id)
        {
            $data = DB::table('tbl_slider')
            ->where('slider_id',$slider_id)
            ->first();
            return view('admin.edit_product')->with('data', $data);
        }

        public function update_slide(Request $request, $product_id)
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
                $data = DB::table('tbl_slider')
                        ->where('product_id',$product_id) 
                        ->update($data);
            Session::put('message','Product Update Successfuly !!');
            return Redirect::to('/all_slide');

        }
        public function delete_slide($slider_id)
        {
            DB::table('tbl_slider')
            ->where('slider_id', $slider_id)
            ->delete();
            Session::put('message','category Delete Successfuly !!'); 
            return Redirect::to('/all_slide');
        }  
}
  