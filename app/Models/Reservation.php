<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'date',
        'time',
        'people',
        'message',
        'status',
    ];

    private function prepare_data(Request $request): array
    {
        return [
            "name" => $request->input('name'),
            "email" => $request->input("email"),
            "phone" => $request->input("phone"),
            "date" => $request->input("date"),
        ];
    }
}