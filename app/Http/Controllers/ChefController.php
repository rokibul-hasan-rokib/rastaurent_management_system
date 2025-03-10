<?php

namespace App\Http\Controllers;

use App\Models\Chefs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request)
    {
        try {
            DB::beginTransaction($request);
            $chefs = (new Chefs())->storeChefs($request);
            DB::commit();
            return redirect()->route('chefs.index')->with('success','Chef Stored Successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
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