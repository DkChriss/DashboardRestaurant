<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dish;
use App\Drink;


class Combo extends Model
{
    protected $table = 'combos';

    protected $fillable = [
        'name',
        'price',
        'drink_id',
        'dish_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s'
    ];

    public function dish()
    {
        return $this->belongsTo(Dish::class,'dish_id','id');
    }

    public function drink()
    {
        return $this->belongsTo(Drink::class,'drink_id','id');
    }
}
