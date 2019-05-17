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
                    @hasanyrole('writer|administrator')
                    <li class="{{ request()->route()->named('admin.employees.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.employees.index') }}">
                            <i class="fa fa-child"></i>
                            <span>Сотрудники</span>
                        </a>
                    </li>
                    {{-- <li class="{{ request()->route()->named('admin.departments.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.departments.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span>Структура компании</span>
                        </a>
                    </li> --}}
                    <li class="{{ request()->route()->named('admin.pages.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.pages.index') }}">
                            <i class="fa fa-newspaper-o"></i>
                            <span>Страницы</span>
                            <span class="pull-right-container">
                                <i class="fa {{ request()->route()->named('admin.pages.*') ? 'fa-angle-down' : 'fa-angle-left' }} pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ request()->route()->named('admin.pages.*') ? 'active' : '' }}">
                                @if(request()->route()->named('admin.pages.*'))
                                    <ul class="treeview-menu">
                                        @foreach (\App\Models\Category::with(['parent', 'categories'])->whereNull('parent_id')->get() as $category)
                                            <li class="{{ (request()->get('category') === $category->slug) || $category->categories->firstWhere('slug', request()->get('category')) ? 'active' : '' }}">
                                                <a href="{{ route('admin.pages.index', ['category' => $category->slug]) }}">
                                                    <i class="fa fa-circle-o"></i>
                                                    {{$category->title}}
                                                    @if($category->categories->count() > 0)
                                                        <span class="pull-right-container">
                                                            <i class="fa {{ request()->get('category') === $category->slug || $category->categories->firstWhere('slug', request()->get('category')) ? 'fa-angle-down' : 'fa-angle-left' }} pull-right"></i>
                                                        </span>
                                                    @endif
                                                </a>
                                                @if($category->categories->count() > 0)
                                                    <ul class="treeview-menu">
                                                        @foreach ($category->categories as $category)
                                                            <li class="{{ request()->get('category') === $category->slug ? 'active' : '' }}">
                                                                <a href="{{ route('admin.pages.index', ['category' => $category->slug]) }}">
                                                                    <i class="fa fa-circle-o"></i>
                                                                    {{$category->title}}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->route()->named('admin.options.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.options.index') }}">
                            <i class="fa fa-cogs"></i>
                            <span>Настройки</span>
                        </a>
                    </li>
                    @endhasanyrole
                    @hasrole('administrator')
                    <li class="header">Администрирование</li>
                    <li class="{{ request()->route()->named('admin.users.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-users"></i>
                            <span>Пользователи</span>
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
