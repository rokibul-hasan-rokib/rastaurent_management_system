<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'menu_item_id', 'quantity', 'price'];

    final public function getAllOrder(): LengthAwarePaginator
    {
        return self::query()
        ->with([
            'order:id,user_id',
            'order.user:id,name', 
            'product:id,name'
        ])
        ->orderBy('id', 'desc')
        ->paginate(15);
     }


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(Product::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'menu_item_id'); // Use 'menu_item_id' as the foreign key
    }
}