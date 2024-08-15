<?php

namespace App\View;

class Action
{

    public const  TYPE_DELETE_ALL = 'DELETE_ALL';
    public const  TYPE_AJAX = 'AJAX';
    public const  TYPE_NORMAL = 'NORMAL';

    //for excel
    public const  TYPE_EXCEL_IMPORT = 'IMPORT';
    public const  TYPE_EXCEL_EXPORT = 'EXPORT';


    public string $name;
    public string $type;
    public string $url;
    public bool $blank;
    public string $route;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isBlank(): bool
    {
        return $this->blank;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }





    /**
     * @return string
     */
    public function getUrl(): string
    {

        if (!empty($this->route)) {
            return route($this->route);
        } elseif (empty($this->url)) {
            return "#";
        }

        return $this->url;
    }


    /**
     * @param string $name
     * @param string $type
     * @param string $url
     * @param string $route
     * @param bool $blank
     */
    public function __construct(string $name, string $type, string $url = '', string $route = '', bool $blank = false)
    {
        $this->name = $name;
        $this->blank = $blank;
        $this->type = $type;
        $this->route = $route;
        $this->url = $url;
    }


    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'blank' => $this->blank,
            'url' => $this->getUrl(),
        ];
    }


}
