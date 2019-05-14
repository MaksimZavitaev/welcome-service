<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Http\Requests\Admin\Pages\HomeRequest;

class HomeController extends Controller
{
    public function edit()
    {
        $page = Page::whereSlug('home')->firstOrFail();
        return view('admin.pages.edit', compact('page'));
    }

    public function update(HomeRequest $request)
    {
        $page = Page::whereSlug('home')->firstOrFail();
        $page->title = $request->input('title');
        $page->announcement = $request->input('announcement');
        $page->content = $request->input('content');
        $page->video = $request->input('video');

        $redirector = redirect()->route('admin.pages.home.edit');

        if($page->save()) {
            return $redirector->withSuccess('Данные успешно сохранены.');
        }

        return $redirector->withInput($request->input())->withErrors('Во время сохранения произошла ошибка.');
    }
}
