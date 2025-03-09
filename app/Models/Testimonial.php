<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Testimonial extends Model
{
    use HasFactory;
    protected $guarded = [];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_LIST = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }


    final public function getAllTestimonial()
    {
        return self::query()->get();
    }

    private function prepareData(Request $request, $existingImage = null): array
    {
        return [
            "name" => $request->input('name'),
            "designation" => $request->input("designation"),
            "description" => $request->input("description"),
            'image' => $request->hasFile('image')
                ? $request->file('image')->store('images', 'public')
                : $existingImage,
        ];
    }

    final public function storeTestimonial(Request $request)
    {
        return self::query()->create($this->prepareData($request));
    }

    final public function updateTestimonial(Request $request, Testimonial $testimonial)
    {
        return $testimonial->update($this->prepareData($request));
    }

    final public function deleteTestimonial(Testimonial $testimonial)
    {
        return $testimonial->delete();
    }
}
