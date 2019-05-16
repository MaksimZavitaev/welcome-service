<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Http\Requests\Admin\PostRequest;

class PageController extends Controller
{
    public function index()
    {
        $post = Page::with('category');
        if(request()->has('category')) {
            $post->whereNull('category_id')
                ->orWhereHas('category', function($query) {
                    $query->where('slug', request()->get('category'));
                });
        }
        
        $items = $post->get()->groupBy(function ($page) {
            return $page->category ? 'posts' : 'pages';
        });
        return view('admin.pages.index',  compact('items'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(PostRequest $request)
    {
        $request->merge([
            'author_id' => auth()->user()->id,
        ]);
        $post = new Page($request->input());

        if($post->save()) {
            return redirect()->route('admin.pages.edit', $post)->withSuccess('Успешно создано.');
        }
        return redirect()->route('admin.pages.crete')
                        ->withInput($request->input())
                        ->withErrors('При сохранении произошла ошибка. Пожалуйста повторите попытку.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $redirector = redirect()->route('admin.pages.home.edit');

        if($page->update(array_filter($request->input()))) {
            return $redirector->withSuccess('Данные успешно сохранены.');
        }

        return $redirector->withInput($request->input())->withErrors('Во время сохранения произошла ошибка.');
    }

    public function destroy(Page $page)
    {
        $redirector = redirect()->route('admin.pages.index');
        if($page->delete()) {
            return $redirector->withSuccess('Успешно удалено.');
        }
        return $redirector->withErrors('При удалении произошла ошибка.');
    }
}
