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
                       href="{{ route('admin.categories.create') }}">
                        Создать
                    </a>
                    <div class="list-group list-group-unbordered">
                        @foreach ($categories as $category)
                            <a class="list-group-item clearfix"
                                href="{{ route("admin.categories.edit", $category) }}">
                                <i class="fa fa-file-text-o"></i>
                                {{ $category->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>
