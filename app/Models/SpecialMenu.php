<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpecialMenu extends Model
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


    final public function getAllSpecialMenus()
    {
        return self::query()->get();
    }

    private function prepareData(Request $request, $existingImage = null): array
    {
        $imagePath = $existingImage;
    
        if ($request->hasFile('image')) {
            if ($existingImage) {
                Storage::disk('public')->delete($existingImage);
            }
    
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('images', $imageName, 'public');
        }
    
        return [
            "title" => $request->input('title'),
            "subheading" => $request->input("subheading"),
            "description" => $request->input("description"),
            'image' => $imagePath,
        ];
    }

    final public function storeSpecialMenu(Request $request)
    {
        return self::query()->create($this->prepareData($request));
    }

    final public function updateSpecialMenu(Request $request, SpecialMenu $specialMenu)
    {
        return $specialMenu->update($this->prepareData($request));
    }

    final public function deleteSpecialMenu(SpecialMenu $specialMenu)
    {
        $specialMenu->delete();
    }
    
}
