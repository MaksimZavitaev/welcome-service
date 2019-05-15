@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::open(['route' => ['admin.posts.store'], 'method' =>'POST']) !!}
        @include('admin.posts._form')
        {!! Form::close() !!}
    </div>
@endsection
