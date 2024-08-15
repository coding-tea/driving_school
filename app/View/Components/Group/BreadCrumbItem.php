<?php

namespace App\View\Components\Group;

use Illuminate\View\Component;

class BreadCrumbItem extends Component
{

    public function __construct(
        public ?string $name ='',
        public ?string $url ='',
    )
    {
    }


    /***
     *
     * @return bool
     */
    public function isCurrentPage(): bool
    {
        return empty($this->getUrl()) || url()->current() == $this->getUrl();
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.group.bread-crumb-item');
    }
}
