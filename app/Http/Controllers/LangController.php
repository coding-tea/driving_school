<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class LangController extends Controller
{
    public function __invoke(Request $request , $locale = 'fr')
    {
        $request->session()->put('locale', $locale);
//        app()->setLocale($locale);
        return back();
    }
}
