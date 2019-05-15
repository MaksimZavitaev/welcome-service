@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($post, ['route' => ['admin.posts.update', $post], 'method' =>'PUT']) !!}
        @include('admin.posts._form')
        {!! Form::close() !!}
    </div>
@stop
