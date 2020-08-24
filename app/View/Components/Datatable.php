<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Datatable extends Component
{
    public $id;
    public $route;
    public $crud;
    public $columns;
    public $order; 
    
    public function __construct(
        $id,
        $route,
        $crud,
        $order = [ 1, 'asc' ],
        $columns
    )
    {
        $this->id = $id;
        $this->route = $route;
        $this->crud = $crud;
        $this->columns = $columns;
        $this->order = $order;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.datatable');
    }
}
