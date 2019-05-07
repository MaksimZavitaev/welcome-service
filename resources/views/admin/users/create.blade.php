@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::open(['route' => ['admin.users.store'], 'method' =>'POST']) !!}
        @include('admin.users._form')
        {!! Form::close() !!}
    </div>
@stop
