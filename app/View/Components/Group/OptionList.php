<?php

namespace App\View\Components\Group;


use App\View\Component;

class OptionList extends Component
{

    /*
     * minimum of selection
     */
    public int $min;
    public int $horizontal;


    /**
     * @param $label
     * @param int $min
     * @param string $name
     * @param bool $required
     * @param bool $readonly
     * @param bool $horizontal
     */
    public function __construct($label, int $min = 0, string $name = "", bool $required = false, bool $readonly = false ,$horizontal = true)
    {
        parent::__construct();
        $this->required = $required;
        $this->name = $name;
        $this->label = ucfirst($label);
        $this->min = $min;
        $this->readonly = $readonly;
        $this->horizontal = $horizontal;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.group.option-list');
    }
}
