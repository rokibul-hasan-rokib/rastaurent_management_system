<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class BookedController extends Controller
{
    public function index(){
        return view('frontend.booked.booked');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'date' => 'required|string',
            'time' => 'required|string',
            'people' => 'required|integer',
            'message' => 'nullable|string',
        ]);

        Reservation::create($request->all());

        return redirect()->route('booked')->with('success', 'Reservation created successfully. You will notifiy a mail if your reservation is accepted');
    }
    
}