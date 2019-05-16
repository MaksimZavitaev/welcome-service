<div class="col-md-12">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Страницы</h3>
                </div>
                <div class="box-body">
                    <div class="list-group list-group-unbordered">
                        @foreach ($items['pages'] as $page)
                            <a class="list-group-item clearfix"
                                href="{{ route("admin.pages.edit", $page) }}">
                                <i class="fa fa-file-text-o"></i>
                                {{ $page->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-xs-8">
            @component('admin.components.boxed_table', [
            'name' => 'Публикации',
            'items' => isset($items['posts']) ? $items['posts'] : [],
            'creatable' =>true,
            'route' => 'admin.pages',
            'columns' => [
                'ID',
                'Заголовок',
                'Создан',
                'Категория',
            ],
            ])
                @if (isset($items['posts']))
                    @foreach ($items['posts'] as $page)
                        <tr>
                            <td style="width: 10px;">{{$page->id}}</td>
                            <td><a href="{{ route('admin.pages.edit', $page) }}">{{$page->title}}</a></td>
                            <td>{{$page->created_at}}</td>
                            <td>{{$page->category ? $page->category->title : 'без категории'}}</td>
                            <td style="width: 10px;">
                                @component('admin.components.delete_button', [
                                'item' => $page,
                                'route' => 'admin.pages.destroy'
                                ])
                                @endcomponent
                            </td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="5">Ни чего не найдено</td>
                </tr>
                @endif
            @endcomponent
        </div>
    </div>
</div>
        
