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
                        <input id="mobile_number" class="form-control" type="text" value="{{ isset($employee) ? $employee->mobile_phone : '' }}" v-mask="'phone'" required>
                    </div>
                    <div class="form-group {{$errors->has('work_number') ? ' has-error' : ''}}">
                        {!! Form::label('work_number', 'Рабочий') !!} <small>+7 (xxx) xxx xx xx</small>
                        <input id="work_number" class="form-control" type="text" value="{{ isset($employee) ? $employee->work_number : '' }}" v-mask="'phone'" required>
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
</div>
<!-- /.box-body -->

@include('admin.shared.form_box_footer')
