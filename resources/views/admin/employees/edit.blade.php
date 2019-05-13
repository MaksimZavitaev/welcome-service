@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($employee, ['route' => ['admin.employees.update', $employee], 'method' =>'PUT']) !!}
        @include('admin.employees._form')
        {!! Form::close() !!}
    </div>
@stop
