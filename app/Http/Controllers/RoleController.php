<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = (new User())->getAllUsers();
        return view('backend.role.index', compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $role)
    {
        return view('backend.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $role)
    {

       try {
        DB::beginTransaction();
        (new User())->updateUser($request,$role);
        DB::commit();
        return redirect()->route('roles.index');
       } catch (\Throwable $th) {
        DB::rollBack();
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $role)
    {
        try {
            DB::beginTransaction();
            (new User())->delete_role($role);
            DB::commit();
            return redirect()->route('roles.index');
           } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('roles.index');
           }
    }
}