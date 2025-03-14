<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Gallery extends Model
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


    final public function getAllGallery()
    {
        return self::query()->get();
    }

    private function prepareData(Request $request, $existingImage = null): array
    {
        return [
            'image' => $request->hasFile('image')
                ? $request->file('image')->store('images', 'public')
                : $existingImage,
        ];
    }

    final public function storeGallery(Request $request)
    {
        return self::query()->create($this->prepareData($request));
    }

    final public function updateGallery(Request $request, Gallery $gallery)
    {
        return $gallery->update($this->prepareData($request));
    }

    final public function deleteGallery(Gallery $gallery)
    {
        return $gallery->delete();
    }

    final public function get()
    {
        return self::query()->where('status', self::STATUS_ACTIVE)->get();
    }
}
