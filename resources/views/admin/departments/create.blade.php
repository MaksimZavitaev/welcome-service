@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::open(['route' => ['admin.departments.store'], 'method' =>'POST']) !!}
        @include('admin.departments._form')
        {!! Form::close() !!}
    </div>
@stop
