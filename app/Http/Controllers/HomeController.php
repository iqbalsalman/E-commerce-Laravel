<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();


class HomeController extends Controller
{
   public function index()
   {
    $data = DB::table('tbl_products')
    ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
    ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
    ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
    ->get(); 
       return view('pages.home_content', ['data' => $data]);

   }
   public function product_by_category($category_id)
   {

      $datas = DB::table('tbl_products')
      ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
      ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
      ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
      ->where('tbl_products.publications_status',1) 
      ->where('tbl_products.category_id', $category_id)
      ->limit(18)
      ->get();
      // echo "<pre>";  print_r($datas); echo "</pre>"; 
      return view('pages/category_by_prodauct', ['datas' => $datas]);

   }
   public function product_by_manufacture($manufacture_id)
   {

      $datas = DB::table('tbl_products')
      ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
      ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
      ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
      ->where('tbl_products.publications_status',1) 
      ->where('tbl_products.manufacture_id', $manufacture_id)
      ->limit(18)
      ->get();
      // echo "<pre>";  print_r($datas); echo "</pre>"; 
      return view('pages/category_by_prodauct', ['datas' => $datas]);

   }

   public function product_detail($product_name)
   {
      $view_name = str_replace('.', '-', $view->getName());
      $datas = DB::table('tbl_products')
      ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
      ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
      ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
      ->where('tbl_products.product_name', $product_name)
      ->get();
      return view('pages/detail_product', ['datas' => $datas]);
   }
}
