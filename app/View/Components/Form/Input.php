<?php

namespace App\View\Components\Form;

use App\View\Component;

class Input extends Component
{


    public $horizontal;
    public $placeholder;
    public $col;
    public $button;


    /**
     * @param string $name
     * @param string $label
     * @param bool $required
     * @param bool $readonly
     * @param string $type
     * @param string|bool $placeholder
     * @param string $parentClasses
     * @param bool $horizontal
     * @param string $col
     * @param null $inputButtonHtml
     * @param bool $showLabele
     * @param bool $bootstrapMaxLength
     */
    public function __construct(
        string      $name,
        string      $label = '',
        bool        $required = false,
        bool        $readonly = false,
        string      $type = 'text',
        string|bool $placeholder = false,
        string      $parentClasses = '',
        bool        $horizontal = true,
        string      $col = "col-12",
        mixed       $inputButtonHtml = null,
        bool        $showLabele = true,
        bool        $bootstrapMaxLength = false,
        string      $defautValue = null,
    )
    {
        parent::__construct();

        if (empty($label)) {
            $this->label = ucwords(cleanString($name));
        } else {
            $this->label = ucwords($label);
        }

        $this->type = $type;
        $this->name = $name;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->horizontal = $horizontal;
        $this->col = $col;
        $this->parentClasses = $parentClasses;
        $this->button = $inputButtonHtml;
        $this->showLabele = $showLabele;
        $this->bootstrapMaxLength = $bootstrapMaxLength;

        if ($placeholder !== false) {
            if (empty($placeholder)) {
                $this->placeholder = $this->label;
            } else {
                $this->placeholder = $placeholder;
            }
        }
        if (isset($defautValue)) {
            $this->value = $defautValue;
        } else
            $this->getValue();


    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public
    function render()
    {
        return view('components.form.input');
    }
}
