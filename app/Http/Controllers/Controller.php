<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\Products;
use App\Models\News;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
     
    public function dashboard() {
      $information = Information::first();
      $raw = $information->banner_pics;
            $clean = trim($raw, '"');
            $clean = stripslashes($clean);
            $banner = json_decode($clean, true);
      return view('index', compact('information', 'banner'));
    }
    public function about(){
      $information = Information::first();
      return view('about', compact('information'));
    }
    public function product(){
      $products = Products::all();
      $information = Information::first();
      return view('products', compact('products', 'information'));
    }
    public function productDetail($id){
      $products = Products::find($id);
      $information = Information::first();
      return view('product_detail', compact('products', 'information'));
    }
    public function news(){
      $information = Information::first();
      $news = News::all();
      return view('news', compact('news', 'information'));
    }
    public function newsDetail($id){
      $information = Information::first();
      $news = News::find($id);
      return view('news_detail', compact('news', 'information'));
    }
}
