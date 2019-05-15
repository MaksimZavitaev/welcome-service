<div class="row">
    <div class="col-xs-12">
        @component('admin.components.boxed_table', [
        'name' => 'Контент',
        'items' => $posts,
        'creatable' =>true,
        'route' => 'admin.posts',
        'columns' => [
            'ID',
            'Заголовок',
            'Создан',
            'Категория',
        ],
        ])
            @foreach ($posts as $post)
                <tr>
                    <td style="width: 10px;">{{$post->id}}</td>
                    <td><a href="{{ route('admin.posts.edit', $post) }}">{{$post->title}}</a></td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->category->title}}</td>
                    <td style="width: 10px;">
                        @component('admin.components.delete_button', [
                        'item' => $post,
                        'route' => 'admin.posts.destroy'
                        ])
                        @endcomponent
                    </td>
                </tr>
            @endforeach
        @endcomponent
    </div>
</div>
