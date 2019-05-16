@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::open(['route' => ['admin.options.store'], 'method' =>'POST']) !!}
        @include('admin.options._form')
        {!! Form::close() !!}
    </div>
@endsection
