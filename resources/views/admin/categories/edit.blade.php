@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($category, ['route' => ['admin.categories.update', $category], 'method' =>'PUT']) !!}
        @include('admin.categories._form')
        {!! Form::close() !!}
    </div>
@stop
