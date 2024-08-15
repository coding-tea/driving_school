<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('pages.profile.index');
    }
}
