<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $table = 'order_detail';
    public $timestamps = false;
    protected $fillable = [
        'orders_id',
        'menus_id',
        'price',
        'amount'
    ];

    public function menus()
    {
        return $this->belongsTo(Menu::class, 'menus_id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'orders_id');
    }

}
