@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::open(['route' => ['admin.categories.store'], 'method' =>'POST']) !!}
        @include('admin.categories._form')
        {!! Form::close() !!}
    </div>
@endsection
