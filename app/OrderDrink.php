<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDrink extends Model
{
    protected $table = 'order_drinks';

    protected $fillable = ['client_id','drink_id','quantity', 'paymentType', 'orderType', 'total'];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s'
    ];
}
