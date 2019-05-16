@extends('admin.wrapper')

@section('content')
    <div class="box box-warning">
        {!! Form::open(['route' => ['admin.pages.store'], 'method' =>'POST']) !!}
        @include('admin.pages._form')
        {!! Form::close() !!}
    </div>
@endsection
