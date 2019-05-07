@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' =>'PUT']) !!}
        @include('admin.users._form')
        {!! Form::close() !!}
    </div>
@stop
