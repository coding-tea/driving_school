<?php

namespace App\View\Components\Form;

use App\View\Component;

use Symfony\Component\HttpKernel\Fragment\FragmentUriGenerator;

class RadioButton extends Component
{


    public array $radios;

    /**
     * @param string $name
     * @param string $label
     * @param array $radios
     * @param bool $required
     */
    public function __construct(string $name, string $label, array $radios , $required = false)
    {
        parent::__construct();
        $this->name = $name;
        $this->label = ucfirst(trim($label));
        $this->radios = $radios;
        $this->required = $required;

    }
    public function generateId()
    {
        $this->id = '';
        return $this->id();
    }


    public function isChecked($value): bool
    {
        if (old($this->name) !== null) {
            return old($this->name) == $value;
        } elseif ($this->isModelExists() && $this->isModel()) {
            return $this->model[$this->name] == $value;
        } else {
            return false;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.radio-button');
    }
}
