{!! Form::model($item, ['method' => 'DELETE', 'route' => [$route, $item], 'class' => 'form-inline']) !!}
{!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>',
[
    'class' => 'btn btn-xs btn-danger',
    'type' => 'submit'
]) !!}
{!! Form::close() !!}
