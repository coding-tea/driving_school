<?php

namespace App\View\Components\Form;


use App\View\Component;

class Checks extends Component
{


    public array $checks;
    public string $col;


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.checks');
    }


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name,
        array  $checks = [],
        string $col = 'col-12',
        string $label = '',
        bool   $required = false,
        bool   $readonly = false,
    )
    {
        parent::__construct();
        $this->name = $name;
        $this->checks = $checks;
        $this->col = $col;
        $this->label = $label;
        $this->required = $required;
        $this->readonly = $readonly;

    }
}
