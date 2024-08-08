<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function __invoke()
    {
        return view('admin.main');
    }
}
