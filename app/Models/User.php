<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    const DEFAULT_PASSWORD = "admin123";

    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';
    const ROLE_SUPERADMIN = 'super admin';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



     protected $guraded = [] ;

     final public function getAllUsers()
     {
        return self::query()->get();
     }

     final public function updateUser(Request $request, User $role){
           return $role->update($this->prepareDataForUpdate($request));
     }

     final public function prepareDataForUpdate(Request $request){
        return [
            "name"=>$request->input('name'),
            "email"=>$request->input('email'),
            "role"=>$request->input('role'),
        ];
     }

     public function delete_role(User $role)
     {
        return $role->delete();
     }

     public function userAssoc(){
        return self::query()->pluck('name','id');
     }

}