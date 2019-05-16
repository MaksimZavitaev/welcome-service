<div class="col-md-12">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Опции</h3>
                </div>
                <div class="box-body">
                    <div class="list-group list-group-unbordered">
                        @foreach ($options as $option)
                            <a class="list-group-item clearfix"
                                href="{{ route("admin.options.edit", $option) }}">
                                <i class="fa fa-circle-o"></i>
                                {{ $option->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
    </div>
</div>
        
