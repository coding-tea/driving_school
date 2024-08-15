<?php

namespace App\View\Components\Form;


use App\View\Component;

class InputDate extends Component
{
    // all properties extended from component class & used by these component
    // ['name','value','label' , 'required' , 'readonly' ]

    public const DATE = 1;
    public const TIME = 2;
    public const DATETIME = 12;



    public $horizontal;
    public $placeholder;
    public $col;
    public $parentClasses;
    public $identifer;
    public $pickerType;

    public bool $clear;

    /**
     * @param $name
     * @param string $label
     * @param bool $required
     * @param bool $readonly
     * @param int $pickerType
     * @param string $parentClasses
     * @param bool $horizontal
     * @param string $col
     * @param null $identifer
     * @param bool $clear
     */
    public function __construct(
        $name,
        string $label = "",
        bool $required = false,
        bool $readonly = false,
        int $pickerType = self::DATE,
        string $parentClasses = '',
        bool $horizontal = true,
        string $col = "col-12",
        $identifer = null,
        bool $clear = false,
        bool $showLabele = true
    )
    {
        parent::__construct();
        if (empty($label)) {
            $this->label = ucwords($name);
        } else {
            $this->label = ucwords($label);
        }
        $this->name = $name;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->pickerType = $pickerType;
        $this->horizontal = $horizontal;
        $this->col = $col;
        $this->identifer = $identifer;
        $this->clear = $clear;
        $this->parentClasses = $parentClasses;
        $this->showLabele = $showLabele;
        $this->getValue();

        if (is_string($identifer) && empty($identifer)) {
            $identifer = null;
        }





    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.form.input-date');
    }
}
