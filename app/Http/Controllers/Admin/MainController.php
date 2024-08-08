<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;

class MainController extends AdminController
{
    public function __invoke()
    {
        return view('admin.main');
    }
}
