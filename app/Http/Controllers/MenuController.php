<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
        $menus = Product::all();
        return view('frontend.menu.menu',compact('menus'));
    }

}