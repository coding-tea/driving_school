<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataImport extends Component
{
    /**
     * Create a new component instance.
     */

    public function __construct(
//        public string $pathSaveFile ,
        public string $name,
        public bool $showButtonExportDataTable = false ,
        public bool $showButtonExportModel = false ,
        public string $downloadRoute = '',
        public string $expotModelRoute = '',
        public array  $actions = [] ,

//        public array  $routes = [],
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.data_import');
    }
}
