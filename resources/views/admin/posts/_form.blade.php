<div class="box-header">
    <h3 class="box-title">{{ isset($post) ? 'Редактирование' : 'Создание' }} контента</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('title', 'Название') !!}
                {!! Form::text('title', isset($post) ? $post->title : null, [
                'class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''),
                'required']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{$errors->has('category_id') ? ' has-error' : ''}}">
                {!! Form::label('category_id','Категория') !!}
                {!! Form::select('category_id', $categories, isset($post) ? $post->category->id : null, [
                'class' => 'form-control select2' . ($errors->has('category_id') ? ' is-invalid' : ''),
                'placeholder' => 'Выберете категорию',
                'required',
                ]) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group {{$errors->has('content') ? ' has-error' : ''}}">
                {!! Form::label('content', 'Содержимое') !!}
                {!! Form::textarea('content', null, [
                'class' => 'form-control',
                'required']) !!}
            </div>
    </div>
    </div>
</div>
@include('admin.shared.form_box_footer')
