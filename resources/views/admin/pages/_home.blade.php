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
        </div>
        <div class="col-md-6">
            <div class="form-group {{$errors->has('video') ? ' has-error' : ''}}">
                {!! Form::label('video', 'Видео') !!}
                {!! Form::text('video', null, [
                'class' => 'form-control',
                'required']) !!}
            </div>
        </div>
        <div class="col-md-12">
            @component('admin.components.trumbowyg', [
                'name' => 'announcement',
                'title' => 'Анонс',
                'options' => [
                    'class' => 'form-control',
                    'required',
                ],
            ])
            @endcomponent
        </div>
        <div class="col-md-12">
            @component('admin.components.trumbowyg', [
                'name' => 'content',
                'title' => 'Содержимое',
                'options' => [
                    'class' => 'form-control',
                    'required',
                ],
            ])
            @endcomponent
        </div>
    </div>
</div>

@include('admin.shared.form_box_footer')
