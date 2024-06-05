<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookedController extends Controller
{
    public function index(){
        return view('frontend.booked.booked');
    }
}