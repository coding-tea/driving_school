<?php

namespace App\View\Components\Table;


use App\Models\App;
use App\View\Component;


class DataTable extends Component
{

    // show or no the checkboxes
    public string $selectRows;
    // datatable columns
    public array $heads;
    // button edit route
    public $editRoute;
    // button delete route
    public $deleteRoute;
    // more routes
    public array $moreRoutes;
    public string $moreHtmlActions;
    // primary key of models inside collection
    public string $primaryKey;
    public string $storagePath;
    public $identifier;
    public $routes;
    public $dataCollection;

    /*
        * show datatable actions like delete
    */
    public $actions;

    /*
        * show or hide checkboxes
    */
    public $showCheckBoxes;


    /**
     * @param array $heads
     * @param array $moreRoutes
     * @param array $routes
     * @param array $actions
     * @param string $editRoute
     * @param string $deleteRoute
     * @param bool $showCheckBoxes
     * @param string $storagePath
     * @param string|null $identifier
     * @param string|null $moreHtmlActions
     * @param bool $selectRows
     */
    public function __construct(

        array  $heads,
        array  $moreRoutes = [],
        array  $routes = [],
        array  $actions = [],
        string $editRoute = '',
        string $deleteRoute = '',
        string $moreHtmlActions = '',
        bool   $showCheckBoxes = true,
        string $storagePath = '/neptune/rtl/storage/app/',
        string $identifier = null,
        bool   $selectRows = true,
        bool   $showLabele = true

    )
    {

        parent::__construct();

        $this->dataCollection = $this->collection ?? null;


        $this->routes = $routes;
        $this->heads = $heads;


        $this->editRoute = $editRoute;
        $this->moreHtmlActions = $moreHtmlActions;
        $this->showCheckBoxes = $showCheckBoxes;
        $this->actions = $actions;
        $this->deleteRoute = $deleteRoute;
        $this->primaryKey = 'frrfd';
        $this->storagePath = $storagePath;
        $this->moreRoutes = $moreRoutes;
        $this->identifier = $identifier;
        $this->selectRows = $selectRows;
        $this->showLabele = $showLabele;


    }

    /**
     * Get edit-delete full route
     * @return string
     */
    public function route($model, $route)
    {

        return route($route, $model["id"]);
    }


    /**
     * Get image
     * @return string
     */
    public function image($model)
    {
        return stream_image_from_uploads( $model->getImagePath() , [
            'default' => ''
        ]);
    }


    public function getFullUrlFromMoreRoute($route_detauls, $model)
    {

        $paras = [];
        foreach ($route_detauls['paras'] as $para) {
            if (!is_array($para)) {
                $paras[] = $model[$para];
            } else {
                foreach ($para as $key => $value) {
                    if (is_null($value)) {

                        $paras[$key] = $model[$key];
                    } else {
                        if (is_array($value)) {
                            $paras[$key] = $model[$value['modelKey']];
                        } else {
                            $paras[$key] = $value;
                        }
                    }
                }

            }
        }

        return route($route_detauls['route'], $paras);

    }

    /**
     * this function will generate full path for delete or update
     * the idea beyond get_class  is to get model primary key if  we don't provide @pk variable
     * @param $route
     * @param $model
     * @return string
     */
    public function generateActionUrlIfNoPk($route, $model)
    {
        if (is_array($route)) {
            $route_name = $route['route'];
            $route_paras = $route['paras'];

            $strings_of_paras = '?';
            foreach ($route_paras as $para_key => $para_val) {
                $strings_of_paras .= "$para_key=$para_val";

                if (array_key_last($route_paras) != $para_key) {
                    $strings_of_paras .= "&";
                }
            }
            return route($route_name, $model[$this->primaryKey]) . $strings_of_paras;
        } else {
            return route($route, $model[$this->primaryKey]);
        }

    }


    public function moreRoutesReadyToUse($routeName, $paras, $model): string
    {
        $res = $this->readArray($paras, $model);
        $string_paras = $this->readArrayPars($paras);
        $string_paras = $string_paras == '?' ? "" : $string_paras;


        if (count($res) === 1) {
            $param = key($res);

            return route($routeName, $res[$param]) . $string_paras;
        }


        return route($routeName, $this->readArray($paras, $model)) . $string_paras;
    }


    public function readArray($array, $model)
    {
        $paras = [];

        foreach ($array as $item) {
            if (!is_array($item)) {
                $paras[$item] = $model[$item];
//                $key = key($item);
//                $paras[$key] = $item[$key];
            }
        }

        return $paras;
    }

    public function readArrayPars($array)
    {
        $array_handled = [];
        $string_pats = "?";

        foreach ($array as $key => $item) {
            if (is_array($item)) {
                $key_paras = key($item);
                $val_paras = $item[$key_paras];
                $string_pats .= "$key_paras=$val_paras";
                if (array_key_last($array) != $key) {
                    $string_pats .= "&";
                }
            }
        }


        return $string_pats;
    }


    public function inputCheckAllId(): string
    {
        return 'mrx-dt-check-all-' . $this->id();
    }

    public function generateTbodyInputCheckboxClass(): string
    {
        return 'mrx-dt-check-row-' . $this->id();
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table.data-table');
    }
}
