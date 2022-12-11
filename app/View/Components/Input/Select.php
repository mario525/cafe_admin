<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $name;
    public $title;
    public $value;
    public $create;
    public $show;
    public $edit;
    public $select;

    public function __construct( $id = "none", $name = "none", $title="prueba",  $value = null,
    $create = false,
    $show = false,
    $edit = false, $select = "none")
    {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->value = $value;
        $this->create = $create;
        $this->show = $show;
        $this->edit = $edit;
        $this->select = $select;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.select');
    }
}
