<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectRemoteData extends Component
{
    public $route;
    public $configFile;
    public $configVarName;
    public $name;
    public $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $route,
        $configFile,
        $configVarName,
        $name,
        $id = ''
    ) {
        $this->route        = $route;
        $this->configFile   = $configFile;
        $this->configVarName = $configVarName;
        $this->name         = $name;
        $this->id           = $id;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.select-remote-data');
    }
}
