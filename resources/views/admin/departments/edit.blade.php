@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($department, ['route' => ['admin.departments.update', $department], 'method' =>'PUT']) !!}
        @include('admin.departments._form')
        {!! Form::close() !!}
    </div>
@stop
