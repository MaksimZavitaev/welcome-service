@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::model($page, ['route' => ["admin.pages.update", $page], 'method' =>'PUT']) !!}
        @includeFirst(['admin.pages._'.$page->slug, 'admin.pages._form'])
        {!! Form::close() !!}
    </div>
@stop
