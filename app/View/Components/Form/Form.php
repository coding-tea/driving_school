<?php

namespace App\View\Components\Form;


use App\View\Component;

class Form extends Component
{
    /**
     * form method.
     */
    public string $method;
    /**
     * form action.
     */
    public string $action;
    public string $title;
    /**
     * model primary key name
     */
    public string $modelPrimaryKeyName;
    /**
     * model primary key value
     */
    public string $modelPrimaryKeyValue;

    /**
     * current userpationts primary in session
     */
    public array $userPrimaryKey;

    /**
     * is form should be with validation or not
     */
    public $withValidation;


    /**
     *
     */
    public $showFormButtons;
    public $showFormSubmitButton;
    public $showFormResetButton;


    /**
     * @param string $method
     * @param string $action
     * @param array $userPk
     * @param string $bindPkKey
     * @param bool $withValidation
     * @param string $title
     */
    public function __construct(
        string $method = '',
        string $action = '',
        array  $userPk = ['UserId', ''],
        string $bindPkKey = '',
        bool   $withValidation = true,
        string $title = '',
        bool   $showFormButtons = true,
        bool   $showFormSubmitButton = true,
        bool   $showFormResetButton = true,

    )
    {

        parent::__construct();


        $this->title = ucfirst($title);
        $this->method = $method;
        $this->action = $action;
        $this->modelPrimaryKeyName = $bindPkKey;
        $this->modelPrimaryKeyValue = '';
        $this->userPrimaryKey = $userPk;
        $this->withValidation = $withValidation;
        $this->showFormButtons = $showFormButtons;
        $this->showFormSubmitButton = $showFormSubmitButton;
        $this->showFormResetButton = $showFormResetButton;
        $this->getPrimaryKey();


    }


    /**
     * get current model pk name and value and put theme inside hidden input
     */
    private function getPrimaryKey(): void
    {
        if ($this->isModelExists() && $this->isModel()) {
            if (!empty($this->modelPrimaryKey)) {
                $this->modelPrimaryKeyValue = $this->model[$this->modelPrimaryKey];
            } else {
//                $this->modelPrimaryKeyName = Helpers::getModelPrimaryKeyName($this->model);
//                $this->modelPrimaryKeyValue = Helpers::getModelPrimaryKey($this->model);
            }
        }

    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.form.form');
    }
}
