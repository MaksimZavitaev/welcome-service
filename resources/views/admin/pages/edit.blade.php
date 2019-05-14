@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($page, ['route' => "admin.pages.$page->slug.update", 'method' =>'PUT']) !!}
        @include('admin.pages._'.$page->slug)
        {!! Form::close() !!}
    </div>
@stop
