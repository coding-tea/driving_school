<?php

namespace App\Traits;

trait Page
{
    /**
     * Adds the page title into the view.
     */
    public function setPageTitle(string $title): void
    {
        $this->shareToView('pageTitle', $title);
    }

    /**
     * Adds the page title into the view.
     */
    public function setPageBreadCrumb(array $pages): void
    {
        $this->shareToView('breadCrumb' , $pages);
    }


    private function shareToView($key , $value): void
    {
        view()->share($key, $value);
    }




}
