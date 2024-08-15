<?php

namespace App\View\Components\Form;


use App\View\Component;


class Select extends Component
{
    public $horizontal;
    /**
     * option as assoc array
     */
    public $options;
    /*
     * options as table
     */
    public $table;
    public $withLoading;

    public $simpleSelect;
    public $disabled;
    public $col;

    /***
     * @var default value for the select
     */
    public $select;

    public $renderdBeforFront;
    public $renderdBeforFrontValue;


    /**
     * @param string $name
     * @param string $label
     * @param null $options
     * @param null $bindWith
     * @param bool $required
     * @param bool $readonly
     * @param bool $renderdBeforFront
     * @param bool $horizontal
     * @param bool $withLoading
     * @param bool $simpleSelect
     * @param string $col
     * @param bool $disabled
     */
    public function __construct(string $name,
                                string $label = '',
                                       $options = null,
                                       $bindWith = null,
                                bool   $required = false,
                                bool   $readonly = false,
                                bool   $renderdBeforFront = false,
                                bool   $horizontal = true,
                                bool   $withLoading = true,
                                bool   $simpleSelect = true,
                                string $col = 'col-12',
                                bool   $disabled = false,
                                bool   $showLabele = true,
                                mixed  $select = null
    )
    {
        parent::__construct();
        $this->name = $name;
        $this->label = ucfirst($label);
        $this->options = $options;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->table = $bindWith;
        $this->horizontal = $horizontal;
        $this->simpleSelect = $simpleSelect;
        $this->col = $col;
        $this->disabled = $disabled;
        $this->withLoading = $withLoading;
        $this->renderdBeforFront = $renderdBeforFront;
        $this->showLabele = $showLabele;
        $this->select = $select;

        if ($this->renderdBeforFront) {
            $this->renderdBeforFrontValue = $this->model[$name];

        }




    }


    /*
     * get the model column witch has same components name
     */
    public function column()
    {

        return $this->model->getRawOriginal($this->name);
    }


    public function getPipeline($keys, $model , $separator = ' '): string
    {
        $final = '';




        if (is_array($keys)) {
            foreach ($keys as $key) {
                $final .= $model[$key] ;
                if ($key === end($keys)) {

                }else{
                    $final .= $separator;
                }
            }

        } else {
            $final = $model[$keys];
        }

        return $final;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {


        return view('components.form.select');
    }
}
