<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Combo;
use App\ModelFilters\DrinkFilter;
use EloquentFilter\Filterable;

class Drink extends Model
{
    use Filterable;
    protected $table = 'drinks';

    protected $fillable = ['name','price', 'description'];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s'
    ];

    public function Combos()
    {
        return $this->belongsToMany(
            Combo::class,
            'dishes',
            'drink_id',
            'dish_id'
        );
    }

    public function modelFilter()
    {
        return $this->provideFilter(DrinkFilter::class);
    }
}
