<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCombo extends Model
{
    protected $table = 'order_combo';

    protected $fillable = ['client_id','combo_id','quantity', 'paymentType', 'orderType', 'total'];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s'
    ];
}
