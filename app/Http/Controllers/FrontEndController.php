<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function testimonial(){
        return view('frontend.testimonial.testimonial');
    }
}
