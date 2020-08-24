<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class DishFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function queryFilter($value)
    {
        return $this->where('name','LIKE' ,"%{$value}%")
        ->orWhere('price', 'LIKE', "%{$value}%");
    }
}
