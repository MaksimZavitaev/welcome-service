@extends('admin.wrapper')

@section('content')
<div class="nav-tabs-custom tab-warning">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#data" data-toggle="tab">Основное</a></li>
        <li><a href="#first_day" data-toggle="tab">Первый день</a></li>
        {{--<li><a href="#history" data-toggle="tab">История</a></li>--}}
    </ul>
    <div class="tab-content">
        <div class="active tab-pane" id="data">
            {!! Form::model($employee, ['route' => ['admin.employees.update', $employee], 'method' =>'PUT']) !!}
            @include('admin.employees._form')
            {!! Form::close() !!}
        </div>
        <div class="tab-pane" id="first_day">
            @php
                $page = $employee->getFirstDayPage();
            @endphp
            {!! Form::model($page, ['route' => ['admin.employees.first_day.update', $employee], 'method' =>'PUT']) !!}
            @include('admin.pages._first_day', ['page' => $page])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
