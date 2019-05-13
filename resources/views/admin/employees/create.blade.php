@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::open(['route' => ['admin.employees.store'], 'method' =>'POST']) !!}
        @include('admin.employees._form')
        {!! Form::close() !!}
    </div>
@stop
