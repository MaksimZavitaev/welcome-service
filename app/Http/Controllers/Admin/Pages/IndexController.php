<?php

namespace App\Http\Controllers\Admin\Pages;

use Illuminate\Routing\Controller;
use App\Models\Page;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('admin.pages.index', [
            'pages' => Page::all(),
        ]);
    }
}
