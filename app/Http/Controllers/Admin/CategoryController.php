<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::all(),
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->input());
        if($category->save()) {
            return redirect()->route('admin.categories.edit', $category)->withSuccess('Категория успешно создана.');
        }
        return redirect()->route('admin.categories.create')
                        ->withInput($request->input())
                        ->withErrors('Во время сохранения произошла ошибка. Пожалуйста повторите попытку.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $result = $category->update(array_filter($request->input()));
        $redirector = redirect()->route('admin.categories.edit');
        if($result) {
            return $redirector->withSuccess('Данные успешно обновлено.');
        }
        return $redirector->withErrors('При обновлении произошла ошибка. Пожалуйста повторите попытку.');
    }

    public function destroy(Category $category)
    {
        $redirector = redirect()->route('admin.categories.index');

        if($category->delete()) {
            return $redirector->withSuccess('Категория успешно удалена.');
        }
        return $redirector->withErrors('При удалении категории произошла ошибка.');
    }
}
