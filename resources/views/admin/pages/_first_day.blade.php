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

<div class="box-footer">
    <button type="submit" class="btn btn-success btn-sm">Принять</button>
    @if (isset($employee) && $employee->pages()->whereSlug('first_day')->first())
        <button id="reset" class="btn btn-warning btn-sm">Сбросить страницу</button>
        @push('scripts')
            <script>
                $('#reset').click(function (e) {
                    e.preventDefault()
                    axios.delete("{{ route('admin.employees.first_day.delete', $employee) }}")
                    .then(function (data) {
                        console.log(data);
                        window.location.reload();
                    })
                });
            </script>
        @endpush
    @endif
</div>

