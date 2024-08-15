<?php

namespace App\View\Components\Form;



use App\View\Component;

class TextArea extends Component
{
    public $parentClasses;
    public  $placeholder;
    public  $col;
    public $horizontal;
    public $useMic;

    public bool $isRichText;


    /**
     * @param string $name
     * @param string $label
     * @param bool $required
     * @param bool $readonly
     * @param string $parentClasses
     * @param string|bool $placeholder
     * @param bool $horizontal
     * @param string $col
     * @param bool $showLabele
     * @param bool $bootstrapMaxLength
     * @param bool $useMic
     * @param bool $is_richtext
     */
    public function __construct(
        string $name,
        string      $label = '',
        bool        $required = false,
        bool        $readonly = false,
        string      $parentClasses = '',
        string|bool $placeholder = false,
        bool        $horizontal = true,
        string      $col = 'col-12',
        bool        $showLabele  = true,
        bool        $bootstrapMaxLength  = false,
        bool        $useMic = false,
        bool   $isRichText = false,

    ) {

        parent::__construct();
        $this->label = ucfirst($label);
        $this->name = $name;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->parentClasses = $parentClasses;
        $this->col = $col;
        $this->horizontal = $horizontal;
        $this->showLabele = $showLabele;
        $this->bootstrapMaxLength  = $bootstrapMaxLength;
        $this->useMic  = $useMic;
        $this->isRichText  = $isRichText;




        if ($placeholder !== false) {
            if (empty($placeholder)) {
                $this->placeholder = $this->label;
            } else {
                $this->placeholder = $placeholder;
            }
        }
        $this->getValue();
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.text-area');
    }
}
