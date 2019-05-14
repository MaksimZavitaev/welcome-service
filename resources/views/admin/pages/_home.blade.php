<div class="box-header">
    <h3 class="box-title">{{ isset($page) ? 'Редактирование' : 'Создание' }} главной страницы</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{$errors->has('title') ? ' has-error' : ''}}">
                {!! Form::label('title', 'Название') !!}
                {!! Form::text('title', null, [
                'class' => 'form-control',
                'required']) !!}
            </div>
            <div class="form-group {{$errors->has('announcement') ? ' has-error' : ''}}">
                {!! Form::label('announcement', 'Анонс') !!}
                {!! Form::textarea('announcement', null, [
                'class' => 'form-control',
                'required']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{$errors->has('video') ? ' has-error' : ''}}">
                {!! Form::label('video', 'Видео') !!}
                {!! Form::text('video', null, [
                'class' => 'form-control',
                'required']) !!}
            </div>
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
