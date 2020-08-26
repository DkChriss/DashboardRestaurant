<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Combo;
use App\ModelFilters\DishFilter;
use EloquentFilter\Filterable;

class Dish extends Model
{
    use Filterable;
    protected $table = 'dishes';

    protected $fillable = ['name','price', 'description'];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s'
    ];

    public function Combos()
    {
        return $this->belongsToMany(
            Combo::class,
            'drinks',
            'dish_id',
            'drink_id'
        );
    }

    public function modelFilter()
    {
        return $this->provideFilter(DishFilter::class);
    }
}
