<div class="col-md-12">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-body">
                    <div class="list-group list-group-unbordered">
                        @foreach ($pages as $page)
                            <a class="list-group-item clearfix"
                                href="{{ route("admin.pages.$page->slug.edit") }}">
                                <i class="fa fa-file-text-o"></i>
                                {{ $page->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>


