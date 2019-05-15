<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\Admin\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::with('category');
        if(request()->has('category')) {
            $post->whereHas('category', function($query) {
                $query->where('slug', request()->get('category'));
            });
        }
        
        $posts = $post->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create', [
            'categories' => Category::pluck('title', 'id'),
        ]);
    }

    public function store(PostRequest $request)
    {
        $request->merge([
            'author_id' => Auth::user()->id,
        ]);
        $post = new Post($request->input());

        if($post->save()) {
            return redirect()->route('admin.posts.edit', $post)->withSuccess('Успешно создано.');
        }
        return redirect()->route('admin.posts.crete')
                        ->withInput($request->input())
                        ->withErrors('При сохранении произошла ошибка. Пожалуйста повторите попытку.');
    }

    public function edit(Post $post)
    {
        $categories = Category::pluck('title', 'id');
        return view('admin.posts.edit', compact('categories', 'post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $result = $post->update(array_filter($request->input()));
        $redirector = redirect()->route('admin.posts.edit', $post);

        if($result) {
            return $redirector->withSuccess('Успешно обновлено');
        }
        return $redirector->withInput($request->input())
                        ->withErrors('При обновлении произошла ошибка. Пожалуйста повторите попытку.');
    }

    public function destroy(Post $post)
    {
        $redirector = redirect()->route('admin.posts.index');
        if($post->delete()) {
            return $redirector->withSuccess('Успешно удалено.');
        }
        return $redirector->withErrors('При удалении произошла ошибка.');
    }
}
