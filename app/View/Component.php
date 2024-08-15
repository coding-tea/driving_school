<?php

namespace App\View;


use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component as BaseComponent;


class Component extends BaseComponent
{
    public $label;
    public $value;
    public $type;
    public $name;
    public $required;
    public $readonly;
    private $id;
    protected $model;
    protected $collection;
    public bool $showLabele = true;

    public bool $bootstrapMaxLength  = false;

    public function __construct()
    {

        if (FormDataBinder::isCollection()) {
            $this->collection = FormDataBinder::get();
            $this->except[] = 'model';
        } else {
            $this->model = FormDataBinder::get();
            $this->except[] = 'collection';
        }
    }


    /*
         * get the status of model prop
     */
    public function isModelExists(): bool
    {
        return isset($this->model);
    }

    /*
     * get the status of model prop
     */
    public function isModel(): bool
    {
        return $this->model instanceof Model;
    }


    /*
     * check if current component has old value or model value
     * its works just with components which has value attr
     */
    protected function getValue(): void
    {
        // check if the old and the model exists in same time
        // priority for old because old run just time if exists

        if (old($this->name) !== null && $this->isModelExists()) {
            $this->value = old($this->name);
        } else {
            if ($this->isModelExists() && $this->isModel()) {
                $this->value = $this->model[$this->name] ?? '';
            } else if (old($this->name) !== null) {
                $this->value = old($this->name) ?? '';
            } else {
                $this->value = "";
            }
        }

    }


    /*
     * generated id
     */
    public function id($length = 20)
    {
        if (!empty($this->id)) {
            return $this->id;
        }
        $codeAlphabet = "-_";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $max = strlen($codeAlphabet); // edited
        for ($i = 0; $i < $length; $i++) {
            $this->id .= $codeAlphabet[random_int(0, $max - 1)];
        }
        return $this->id;
    }

    public function render()
    {
        // TODO: Implement render() method.
    }
}
