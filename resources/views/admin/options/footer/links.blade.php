<div class="box-header">
    <h3 class="box-title">{{ isset($option) ? 'Редактирование' : 'Создание' }}</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('name', 'Название') !!}
                {!! Form::text('name', isset($option) ? $option->name : null, [
                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                'required']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{$errors->has('values') ? ' has-error' : ''}}">
                {!! Form::label('values', 'Ссылки') !!}
                <multi-link name="values" items='@json($option->values)'></multi-link>
            </div>
        </div>
    </div>
</div>
@include('admin.shared.form_box_footer')
