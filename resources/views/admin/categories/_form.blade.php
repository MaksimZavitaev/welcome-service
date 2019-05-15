<div class="box-header">
    <h3 class="box-title">{{ isset($category) ? 'Редактирование' : 'Создание' }} категории</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <h3>Данные</h3>
            <div class="form-group">
                {!! Form::label('title', 'Название') !!}
                {!! Form::text('title', isset($category) ? $category->title : null, [
                'class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''),
                'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('slug', 'Алиас') !!}
                {!! Form::text('slug', isset($category) ? $category->slug : null, [
                'class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''),
                'required']) !!}
            </div>
        </div>
    </div>
</div>
@include('admin.shared.form_box_footer')
