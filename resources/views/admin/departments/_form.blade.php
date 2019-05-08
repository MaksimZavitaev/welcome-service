@php
    /** @var \App\Models\Department $department */
$pid = request()->input('pid');
@endphp

<div class="box-header">
    <h3 class="box-title">{{ isset($department) ? 'Редактирование' : 'Создание' }} подразделения</h3>
    <div class="box-tools">
        @if(isset($department))
            @component('admin.components.delete_button', [
            'item' => $department,
            'route' => 'admin.departments.destroy',
            ])
            @endcomponent
        @endif
    </div>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <h3>Данные</h3>
            <div class="form-group">
                {!! Form::label('title', 'Название') !!}
                {!! Form::text('title', isset($department) ? $department->title : null, [
                'class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''),
                'required']) !!}
            </div>
            <div class="form-group {{$errors->has('parent_id') ? 'has-error' : ''}}">
                {!! Form::label('parent_id', 'Родитель') !!}
                {!! Form::select('parent_id', $departments, (isset($department) && $department->parent !== null) ? $department->parent->id : $pid,[
                'class' => 'form-control select2',
                'placeholder' => 'Без родителя']) !!}
            </div>
        </div>
    </div>
</div>
@include('admin.shared.form_box_footer')
