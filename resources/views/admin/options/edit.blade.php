@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($option, ['route' => ["admin.options.update", $option], 'method' =>'PUT']) !!}
        {!! Form::hidden('key', $option->key) !!}
        @include("admin.options.$option->key")
        {!! Form::close() !!}
    </div>
@stop
