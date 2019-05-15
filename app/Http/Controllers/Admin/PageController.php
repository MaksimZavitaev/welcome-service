<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function __invoke()
    {
        return view('admin.pages.index', [
            'pages' => Page::all(),
        ]);
    }
}
