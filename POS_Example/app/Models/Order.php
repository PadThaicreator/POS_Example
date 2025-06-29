<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    protected $table = 'orders';
    protected $fillable = [
        'customer_id',
        'staff_id',
        'totalPrice'
    ];

    // เพิ่มความสัมพันธ์กับ customers
    public function customer()
    {
        return $this->belongsTo(Member::class, 'customer_id');
    }

    // เพิ่มความสัมพันธ์กับ staff
    public function staff()
    {
        return $this->belongsTo(Member::class, 'staff_id');
    }
}


