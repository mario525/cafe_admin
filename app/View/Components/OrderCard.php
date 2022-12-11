<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OrderCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $value;
    public $color;
    public function __construct($value, $color="red")
    {
        $this->value = $value;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order-card');
    }
}
