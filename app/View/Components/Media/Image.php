<?php

namespace App\View\Components\Media;

use Illuminate\View\Component;

class Image extends Component
{

    public string $alt;
    public string $src;
    public string $loaderPath;
    public bool $lazyload;

    /**
     * @param string $alt
     * @param string $src
     * @param bool $lazyload
     */
    public function __construct(string $src = '', string $alt = '', bool $lazyload = true)
    {
        $this->alt = $alt ?: trans('app.logo');
        $this->src = $src;
        $this->lazyload = $lazyload;
        $this->loaderPath =  "";
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.media.image');
    }
}
