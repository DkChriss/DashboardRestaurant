<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderDrink;
use App\OrderDish;
use App\OrderCombo;
use App\User;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = ['name','lastname','ci','user_id'];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s'
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }

    public function orderDrinks()
    {
        return $this->belongsToMany(
            OrderDrink::class,
            'drinks',
            'client_id',
            'drink_id',
        );
    }

    public function orderDishes()
    {
        return $this->belongsToMany(
            OrderDish::class,
            'dishes',
            'client_id',
            'dish_id'
        );
    }

    public function orderCombos()
    {
        return $this->belongsToMany(
            OrderCombo::class,
            'combos',
            'client_id',
            'dish_id'
        );
    }
}
