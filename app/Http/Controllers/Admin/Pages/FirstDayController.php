<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Http\Requests\Admin\Pages\FirstDayRequest;

class FirstDayController extends Controller
{
    public function edit()
    {
        $page = Page::whereSlug('first_day')->firstOrFail();
        return view('admin.pages.edit', compact('page'));
    }

    public function update(FirstDayRequest $request)
    {
        $page = Page::whereSlug('first_day')->firstOrFail();
        $page->title = $request->input('title');
        $page->content = $request->input('content');
        $page->block = $request->input('block');
        $page->steps = $request->input('steps');

        $redirector = redirect()->route('admin.pages.first_day.edit');

        if($page->save()) {
            return $redirector->withSuccess('Данные успешно сохранены.');
        }

        return $redirector->withInput($request->input())->withErrors('Во время сохранения произошла ошибка.');
    }
}
