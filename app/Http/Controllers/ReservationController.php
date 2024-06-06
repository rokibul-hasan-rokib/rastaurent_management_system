<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Notifications\ReservationAccepted;
use Illuminate\Support\Facades\Notification; 
class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('backend.reservations.index', compact('reservations'));
    }

    // public function create()
    // {
    //     return view('reservations.create');
    // }

   

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
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

        $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }
    public function editStatus($id)
    {
        $reservation = Reservation::find($id);
        
        if (!$reservation) {
            return redirect()->route('reservations.index')->with('error', 'Reservation not found.');
        }

        return view('backend.reservations.status', compact('reservation'));
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        
        if (!$reservation) {
            return redirect()->route('reservations.index')->with('error', 'Reservation not found.');
        }

        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $reservation->status = $request->status;
        $reservation->save();

        if ($reservation->status == 'accepted') {
            Notification::route('mail', $reservation->email)->notify(new ReservationAccepted($reservation));
        }

        return redirect()->route('reservations.index')->with('success', 'Reservation status updated successfully.');
    }
}