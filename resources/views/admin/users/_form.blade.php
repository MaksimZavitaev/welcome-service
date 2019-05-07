@php
    /** @var \App\Models\User $user */
@endphp

<div class="box-header">
    <h3 class="box-title">{{ isset($user) ? 'Редактирование' : 'Создание' }} пользователя</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <h3>Данные</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                        {!! Form::label('name', 'Имя') !!}
                        {!! Form::text('name', null, [
                        'class' => 'form-control',
                        'required']) !!}
                    </div>
                    <div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
                        {!! Form::label('email', 'E-mail') !!}
                        {!! Form::text('email', null, [
                        'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{$errors->has('password') ? ' has-error' : ''}}">
                        {!! Form::label('password', 'Пароль') !!}
                        {!! Form::password('password', [
                        'class' => 'form-control',
                        'required' => !isset($user)]) !!}
                    </div>
                    <div class="form-group {{$errors->has('password') ? ' has-error' : ''}}">
                        {!! Form::label('password_confirmation', 'Повторите пароль') !!}
                        {!! Form::password('password_confirmation', [
                        'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h3>Привилегии</h3>
            <div class="form-group">
                {!! Form::label('roles','Роли') !!}
                {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id') : null, [
                'class' => 'form-control select2' . ($errors->has('roles') ? ' is-invalid' : ''),
                'multiple']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('permissions','Права') !!}
                {!! Form::select('permissions[]', $permissions, isset($user) ? $user->permissions->pluck('id') : null, [
                'class' => 'form-control select2' . ($errors->has('permissions') ? ' is-invalid' : ''),
                'multiple']) !!}
            </div>
        </div>
    </div>
</div>
<!-- /.box-body -->

@include('admin.shared.form_box_footer')
