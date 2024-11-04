<?php

namespace App\Models;

use App\Mail\OrderStatusChanged;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_amount', 'status'];

    public const STATUS_CONFIRM = "confirmed";
    public const STATUS_PENDING = 'pending';
    public const STATUS_REJECTED = 'rejected';

    public const STATUS_LIST = [
        self::STATUS_CONFIRM => 'confirmed',
        self::STATUS_REJECTED => 'rejected',
        self::STATUS_PENDING => 'pending',
    ];

    final public function getAllOrder(): LengthAwarePaginator
    {
        return self::query()
        ->with([
            'user:id,name',
        ])
        ->orderBy('id', 'desc')
        ->paginate(15);
     }

     final public function delete_order($id)
     {
              $order = self::query()->findOrFail($id);
              $order->orderItems()->delete();
              return $order->delete();
     }



    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}