@php
    $pid = Request::get('pid', 1);
@endphp

<div class="col-md-12">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-body">
                    <a class="btn btn-sm btn-block btn-success"
                       type="button"
                       href="{{ route('admin.departments.create') }}">
                        Создать
                    </a>
                    <div class="list-group list-group-unbordered">
                        @foreach($departments->sortBy('name') as $department)
                            <a class="list-group-item clearfix {{ !$department->childs_count ? 'disabled' : '' }}"
                               href="{{ $department->childs_count ? route('admin.departments.index', ['pid' => $department]) : '#' }}">
                                <i class="fa fa-folder-o"></i>
                                {{ $department->title }}
                                <object class="pull-right">
                                    <div class="btn-group btn-group-xs">
                                        <a href="{{ route('admin.departments.create', ['pid' => $department]) }}"
                                           class="btn btn-success" type="button">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a href="{{ route('admin.departments.edit', $department) }}"
                                           class="btn btn-warning" type="button">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                </object>
                            </a>
                        @endforeach
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>
