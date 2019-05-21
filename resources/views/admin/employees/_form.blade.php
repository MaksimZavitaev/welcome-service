<div class="box-header">
    <h3 class="box-title">{{ isset($employee) ? 'Редактирование' : 'Создание' }} сотрудника</h3>
</div>
<div class="box-body">
    <div class="form-group">
        {!! Form::checkbox('active', true, !isset($employee) ?: !$employee->deleted_at, ['class' => 'flat-orange']) !!}
        {!! Form::label('active', 'Активен') !!}
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3>Данные</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{$errors->has('lastname') ? ' has-error' : ''}}">
                        {!! Form::label('lastname', 'Фамилия') !!}
                        {!! Form::text('lastname', null, [
                        'class' => 'form-control',
                        'required']) !!}
                    </div>
                    <div class="form-group {{$errors->has('firstname') ? ' has-error' : ''}}">
                        {!! Form::label('firstname', 'Имя') !!}
                        {!! Form::text('firstname', null, [
                        'class' => 'form-control',
                        'required']) !!}
                    </div>
                    <div class="form-group {{$errors->has('patronymic') ? ' has-error' : ''}}">
                        {!! Form::label('patronymic', ' Отчество') !!}
                        {!! Form::text('patronymic', null, [
                        'class' => 'form-control',
                        'required']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
                        {!! Form::label('email', 'E-mail') !!}
                        {!! Form::text('email', null, [
                        'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group {{$errors->has('mobile_number') ? ' has-error' : ''}}">
                        {!! Form::label('mobile_number', 'Мобильный') !!} <small>+7 (xxx) xxx xx xx</small>
                        <input id="mobile_number" class="form-control" name="mobile_number" type="text" value="{{ isset($employee) ? $employee->mobile_number : '' }}" v-mask="'phone'" required>
                    </div>
                    <div class="form-group {{$errors->has('work_number') ? ' has-error' : ''}}">
                        {!! Form::label('work_number', 'Рабочий') !!} <small>+7 (xxx) xxx xx xx</small>
                        <input id="work_number" class="form-control" name="work_number" type="text" value="{{ isset($employee) ? $employee->work_number : '' }}" v-mask="'phone'" required>
                    </div>
                    <div class="form-group {{$errors->has('extension_number') ? ' has-error' : ''}}">
                        {!! Form::label('extension_number', 'Внутренний') !!} <small>xxxxx</small>
                        {!! Form::text('extension_number', null, [
                        'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h3>Должность и подразделение</h3>
            <div class="form-group {{$errors->has('department') ? ' has-error' : ''}}">
                {!! Form::label('department', ' Подразделение') !!}
                {!! Form::text('department', null, [
                'class' => 'form-control',
                'required']) !!}
            </div>
            <div class="form-group {{$errors->has('position') ? ' has-error' : ''}}">
                {!! Form::label('position', ' Должность') !!}
                {!! Form::text('position', null, [
                'class' => 'form-control',
                'required']) !!}
            </div>
            {{-- <div class="form-group {{$errors->has('department_id') ? ' has-error' : ''}}">
                {!! Form::label('department_id','Подразделение') !!}
                {!! Form::select('department_id', $departments, isset($employee) ? $employee->department->pluck('id') : null, [
                'class' => 'form-control select2' . ($errors->has('department_id') ? ' is-invalid' : ''),
                'placeholder' => 'Выберете подразделение',
                'required',
                ]) !!}
            </div> --}}
        </div>
    </div>
    @isset($employee)
        <div class="row">
            <div class="col-md-4">
                @if($employee->short_url)
                    <div class="form-group {{$errors->has('short_url') ? ' has-error' : ''}}">
                        {!! Form::label('short_url', 'Короткая ссылка') !!}
                        {!! Form::text('short_url', $employee->short_url ?? 'Не сгенерировано', [
                            'class' => 'form-control',
                            'required', 'disabled']) !!}
                    </div>
                @else
                    <div class="form-group {{$errors->has('short_url') ? ' has-error' : ''}}">
                        {!! Form::label('short_url', 'Короткая ссылка') !!}
                        <div class="input-group">
                            {!! Form::text('short_url', $employee->short_url ?? 'Не сгенерировано', [
                            'class' => 'form-control',
                            'required', 'disabled']) !!}
                            <span class="input-group-btn">
                                <button type="button" id="create_short_link" class="btn btn-warning btn-flat">Получить ссылку</button>
                            </span>
                        </div>
                    </div>
                @endif
            </div>
            @isset($employee->short_url)
                <div class="col-md-4">
                    <div class="form-group {{$errors->has('department') ? ' has-error' : ''}}">
                        {!! Form::label('mail_sended_at', 'Письмо отправлено') !!}
                        <div class="input-group">
                            {!! Form::text('mail_sended_at', $employee->mail_sended_at ?? 'Нет', [
                            'class' => 'form-control',
                            'required', 'disabled']) !!}
                            <span class="input-group-btn">
                                <button type="button" data-type="welcome_mail" class="btn btn-warning btn-flat send_welcome">{{ $employee->mail_sended_at ? 'Отправить повторно' : 'Отправить' }}</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group {{$errors->has('department') ? ' has-error' : ''}}">
                        {!! Form::label('sms_sended_at', 'SMS отправлено') !!}
                        <div class="input-group">
                            {!! Form::text('sms_sended_at', $employee->sms_sended_at ?? 'Нет', [
                            'class' => 'form-control',
                            'required', 'disabled']) !!}
                            <span class="input-group-btn">
                                <button type="button" data-type="welcome_sms" class="btn btn-warning btn-flat send_welcome">{{ $employee->sms_sended_at ? 'Отправить повторно' : 'Отправить' }}</button>
                            </span>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    @endisset
</div>
<!-- /.box-body -->

@include('admin.shared.form_box_footer')

@isset($employee)
    @push('scripts')
        <script>
            function processor(e) {
                e.preventDefault();
                var el = $(e.currentTarget);
                var text = el.text();
                var icon = $('<i class="fa"></i>').addClass('fa-spinner fa-pulse');
                return {
                    start: function () {
                        el.html(icon);
                    },
                    stop: function () {
                        el.text(text);
                    }
                }
            }

            $('.send_welcome').click(function (e) {
                var type = $(e.currentTarget).data('type');
                var process = processor(e);
                process.start();
                axios.post('/admin/employees/{{$employee->id}}/send/' + type).then(function (res) {
                    window.location.href = '/admin/employees/{{$employee->id}}/edit';
                    process.stop();
                }).catch(function (error) {
                    process.stop();
                });
            });

            $('#create_short_link').click(function (e) {
                var process = processor(e);
                process.start();
                axios.post('/admin/employees/{{$employee->id}}/generate_short_link').then(function (res) {
                    window.location.href = '/admin/employees/{{$employee->id}}/edit';
                    process.stop();
                }).catch(function (error) {
                    process.stop();
                });
            })
        </script>
    @endpush
@endisset
