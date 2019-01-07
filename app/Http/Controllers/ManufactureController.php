<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ManufactureController extends Controller
{
    function index()
    {
       return view('admin.add_manufacture');
    }
    public function all_manufacture()
    {
        $all_manufacture_info = DB::table('tbl_manufacture')->get();
        return view('admin/all_manufacture', ['all_manufacture_info' => $all_manufacture_info]);
    }
    public function save_manufacture(Request $request)
    {
        $data = array();
        $data  ['manufacture_id']          = $request->manufacture_id;
        $data  ['manufacture_name']        = $request->manufacture_name;
        $data  ['manufacture_description'] = $request->manufacture_description;
        $data  ['publications_status']     = $request->publications_status;
        $data  ['created_at']              =  Carbon::now('Asia/jakarta');
        DB::table('tbl_manufacture')->insert($data);
        Session::put('message','Manufacture added Successfuly !!');
        return Redirect::to('/add_manufacture');
    }
    public function edit_manufacture($manufacture_id)
    {
         $manufacture_info  = DB::table('tbl_manufacture')
                              ->where('manufacture_id', $manufacture_id)
                              ->first();
        return view('admin.edit_manufacture')
                    ->with('data', $manufacture_info);
    }

    public function update_manufacture(Request $request, $manufacture_id)
    {
        $data = array();
        $data  ['manufacture_name']        = $request->manufacture_name;
        $data  ['manufacture_description'] = $request->manufacture_description;
        $data  ['created_at']           =  Carbon::now('Asia/jakarta');

                            DB::table('tbl_manufacture')
                            ->where('manufacture_id', $manufacture_id)
                            ->update($data);
        Session::put('message','Manufacture Update Successfuly !!'); 
        return Redirect::to('/all_manufacture');
    }
    public function unactive_manufacture($manufacture_id)
    {
        DB::table('tbl_manufacture')
        ->where('manufacture_id', $manufacture_id)
        ->update(['publications_status' => 0 ]);   
        Session::put('message','Manufacture Unactive Successfuly !!');      
        return Redirect::to('/all_manufacture');
    }

    public function active_manufacture($manufacture_id)
    {
        DB::table('tbl_manufacture')
        ->where('manufacture_id', $manufacture_id)
        ->update(['publications_status' => 1 ]);   
        Session::put('message','Manufacture active Successfuly !!');      
        return Redirect::to('/all_manufacture');
    }

    public function delete_manufacture($manufacture_id)
    {
        DB::table('tbl_manufacture')
        ->where('manufacture_id', $manufacture_id)
        ->delete();
        Session::put('message','Manufacture Delete Successfuly !!'); 
        return Redirect::to('/all_manufacture');
    }
}
