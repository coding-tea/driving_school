<?php

namespace App\View\Components\Form;



use App\View\Component;

class Radio extends Component
{

// all properties extended from component class & used by these component
    // ['name','value','label']
    public bool $checked;

    /**
     * @param string $name
     * @param string $label
     * @param string $value
     */
    public function __construct(string $name, string $label, string $value)
    {
        parent::__construct();
        $this->name = $name;
        $this->label = ucfirst($label);
        $this->value = $value;

        if (old($name) !== null) {
            $this->checked = old($name) == $value;
        } elseif ($this->isModelExists() && $this->isModel()) {
            $this->checked = $this->model[$this->name] == $value;
        }else{
            $this->checked = false;
        }





    }



    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.radio');
    }
}
