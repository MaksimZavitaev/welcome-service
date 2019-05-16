<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Http\Requests\Admin\OptionRequest;

class OptionController extends Controller
{
    public function index()
    {
        return view('admin.options.index', [
            'options' => Option::all(),
        ]);
    }

    public function edit(Option $option)
    {
        return view('admin.options.edit', compact('option'));
    }

    public function update(OptionRequest $request, Option $option)
    {
        $result = $option->update(array_filter($request->input()));
        $redirector = redirect()->route('admin.options.edit', $option);

        if($result) {
            return $redirector->withSuccess('Успешно');
        }
        return $redirector->withInput($request->input())->withErrors('Произошла ошибка');
    }
}
