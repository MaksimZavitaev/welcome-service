<div class="row">
    <div class="col-xs-12">
        @component('admin.components.boxed_table', [
        'name' => 'Пользователи',
        'items' => $users,
        'row' => 'admin.users._row',
        'creatable' =>true,
        'route' => 'admin.users',
        'columns' => [
            'ID',
            'Пользователь',
            'Создан',
            'Роли',
        ],
        ])
            @foreach($users as $user)
                <tr>
                    <td style="width: 10px;">{{$user->id}}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}">
                            {{$user->name}}
                        </a>
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td>
                        @forelse($user->roles as $role)
                            <span class="label label-warning text-black">{{ __('roles.' . $role->name) }}</span>
                        @empty
                            Ничего
                        @endforelse
                    </td>
                    <td style="width: 10px;">
                        @component('admin.components.delete_button', [
                        'item' => $user,
                        'route' => 'admin.users.destroy'
                        ])
                        @endcomponent
                    </td>
                </tr>
            @endforeach
        @endcomponent
    </div>
</div>
