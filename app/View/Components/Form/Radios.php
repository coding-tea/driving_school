<?php

namespace App\View\Components\Form;

use App\View\Component;

class Radios extends Component
{
    public array $radios;
    public string $tooltip;
    public string $col;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name,
        array  $radios = [],
        string $label = '',
        string $tooltip = '',
        bool   $required = false,
        string $col = 'col-12'
    )
    {
        parent::__construct();
        $this->name = $name;
        $this->radios = $radios;
        $this->label = $label;
        $this->tooltip = $tooltip;
        $this->required = $required;
        $this->col = $col;

    }

    public function id($length = 20)
    {
        $codeAlphabet = "-_";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $max = strlen($codeAlphabet); // edited
        $id = '';
        for ($i = 0; $i < $length; $i++) {
            $id .= $codeAlphabet[random_int(0, $max - 1)];
        }
        return $id;
    }


    public function isRadioChecked($value)
    {
        if (old($this->name) !== null) {
            return old($this->name) == $value;
        } elseif ($this->isModelExists() && $this->isModel()) {
            return $this->model[$this->name] == $value;
        }
        return false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.radios');
    }
}
