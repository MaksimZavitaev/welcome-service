@extends('admin.layout')

@section('wrapper')
    <div class="wrapper">
        <header class="main-header">
            <a href="/" class="logo">
                <span class="logo-lg"><b>СК</b> Согласие</span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <form method="POST" action="{{ route('admin.logout') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-default btn-flat">Выйти</button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu" data-widget="tree">
                    @hasrole('administrator')
                    <li class="header">Администрирование</li>
                    <li class="{{ request()->route()->named('admin.users.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-users"></i>
                            <span>Пользователи</span>
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('admin.employees.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.employees.index') }}">
                            <i class="fa fa-child"></i>
                            <span>Сотрудники</span>
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('admin.departments.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.departments.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span>Структура компании</span>
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('admin.pages.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.pages.index') }}">
                            <i class="fa fa-newspaper-o"></i>
                            <span>Страницы</span>
                        </a>
                    </li>
                    @endhasrole
                </ul>
            </section>
        </aside>

        <div class="content-wrapper">
            <section class="content-header">
            </section>

            <section class="content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                    </div>
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <strong>&copy; {{ date('Y') }} <a href="https://www.soglasie.ru">ООО «СК «СОГЛАСИЕ»</a></strong>
        </footer>
    </div>
@endsection
