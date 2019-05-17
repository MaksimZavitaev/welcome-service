<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        if(!auth()->guard('employee')->check()) {
            return view('401');
        }

        return view('index');
    }
}
