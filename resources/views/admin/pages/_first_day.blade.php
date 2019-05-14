<div class="box-header">
    <h3 class="box-title">{{ isset($page) ? 'Редактирование' : 'Создание' }} страницы 1-й день в компании</h3>
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
            <div class="form-group {{$errors->has('block') ? ' has-error' : ''}}">
                {!! Form::label('block', 'Блок') !!}
                {!! Form::textarea('block', null, [
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
        <div class="col-md-6">
            <div class="form-group {{$errors->has('steps') ? ' has-error' : ''}}">
                {!! Form::label('steps', 'Шаги') !!}
                <multi-input name="steps" items='@json($page->steps)'></multi-input>
            </div>
        </div>
    </div>
</div>

@include('admin.shared.form_box_footer')