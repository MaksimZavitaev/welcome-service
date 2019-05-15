<div class="row">
    <div class="col-xs-12">
        @component('admin.components.boxed_table', [
        'name' => 'Сотрудники',
        'items' => $employees,
        'row' => 'admin.employees._row',
        'creatable' =>true,
        'route' => 'admin.employees',
        'columns' => [
            'ID',
            'ФИО',
            'Создан',
            'Отдел',
            'Должность',
        ],
        ])
            @foreach ($employees as $item)
                <tr class="{{$item->deleted_at ? 'danger' : '' }}">
                    <td style="width: 10px;">{{$item->id}}</td>
                    <td><a href="{{ route('admin.employees.edit', $item) }}">{{$item->fullname}}</a></td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->department}}</td>
                    <td>{{$item->position}}</td>
                    <td style="width: 10px;">
                        @if(!$item->deleted_at)
                            @component('admin.components.delete_button', [
                            'item' => $item,
                            'route' => 'admin.employees.destroy'
                            ])
                            @endcomponent
                        @endif
                    </td>
                </tr>
            @endforeach
        @endcomponent
    </div>
</div>
