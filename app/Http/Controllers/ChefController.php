<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChefController extends Controller
{
    public function index(){
        $chefs = (new Chefs())->getAllChefs();
        return view('backend.chef.chef',compact('chefs'));
    }

    public function create()
    {
        return view('backend.chef.create');
    }

    public function store()
    {
        try {
            DB::beginTransaction(Request $request);
            $chefs = (new Chefs())->storeChefs($request);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            //throw $th;
        }
    }
    public function destroy(Chefs $chefs)
    {
        try {
            DB::beginTransaction();
            (new Chefs())->deleteChefs($chefs);
            DB::commit();
            return redirect()->route('chefs.index')->with('success', 'Chefs deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}