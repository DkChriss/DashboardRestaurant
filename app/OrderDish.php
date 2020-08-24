<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDish extends Model
{
    protected $table = 'order_dishes';
    
    protected $fillable = ['client_id','dish_id','quantity', 'paymentType', 'orderType', 'total'];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s'
    ];
}
