<?php

namespace App\Traits;

trait Alertable
{

    private function format(
        $text, $title, $alertType
    ): array
    {
        return [
            'alert' => [
                'text' => $text,
                'title' => $title,
                'icon' => $alertType
            ]
        ];
    }


    public function question($title = '', $text = '',  $flash = true): array
    {
        $alert = $this->format($title, $text, __FUNCTION__);
        if ($flash) {
            session()->flash(key($alert), $alert[key($alert)]);
        }
        return $alert;
    }

    public function success($title = '', $text = '', $flash = true): array
    {
        $alert = $this->format($title, $text, __FUNCTION__);
        if ($flash) {
            session()->flash(key($alert), $alert[key($alert)]);
        }
        return $alert;
    }

    public function error($title = '', $text = '' , $flash = true)
    {
        $alert = $this->format($title, $text, __FUNCTION__);
        if ($flash) {
            session()->flash(key($alert), $alert[key($alert)]);
        }
        return $alert;
    }


    public function info($title = '', $text = '' , $flash = true)
    {
        $alert = $this->format($title, $text, __FUNCTION__);
        if ($flash) {
            session()->flash(key($alert), $alert[key($alert)]);
        }
        return $alert;
    }

    public function warning($title = '', $text = '' , $flash = true)
    {
        $alert = $this->format($title, $text, __FUNCTION__);
        if ($flash) {
            session()->flash(key($alert), $alert[key($alert)]);
        }
        return $alert;
    }

}
