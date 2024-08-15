<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    private function redirectTo($link)
    {

    }


    public function facebook()
    {
        return redirect(config('gdd.social_media.facebook'));
    }

    public function twitter()
    {
        return redirect(config('gdd.social_media.twitter'));
    }

    public function instagram()
    {
        return redirect(config('gdd.social_media.instagram'));
    }

    public function linkedin()
    {
        return redirect(config('gdd.social_media.linkedin'));
    }
}
