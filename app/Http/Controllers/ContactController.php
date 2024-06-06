<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;


class ContactController extends Controller
{
    public function index(){
        return view('frontend.contact.contact');
    }
    public function index2(){
        $contacts = Contact::all();
        return view('backend.contact.index', compact('contacts'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return redirect()->route('contact')->with('success', 'Contact message sent successfully.');
    }
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact message deleted successfully.');
    }
}