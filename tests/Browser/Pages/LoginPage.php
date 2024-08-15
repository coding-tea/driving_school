<?php

namespace Tests\Browser\Pages;

use App\Models\UserManagement\User;
use Laravel\Dusk\Browser;

class LoginPage extends Page
{
    public function url()
    {
        return 'https://atlecs.net/gdd/public/login';
    }

    public function loginUser(Browser $browser, $email, $password)
    {
        $browser
            ->type('login', $email)
            ->type('password', $password)
            ->press("#kt_sign_in_submit");
    }
}
