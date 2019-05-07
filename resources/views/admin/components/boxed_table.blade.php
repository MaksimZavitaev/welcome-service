<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">{{$name}}</h3>

        <div class="box-tools">
            @if(isset($creatable) && $creatable)
                <a href="{{route("{$route}.create")}}" class="btn btn-sm btn-primary pull-right"
                   type="button">Создать</a>
            @endif
            @if(isset($searchable) && $searchable)
                {!! Form::open(['route' => ["{$route}.index"], 'method' =>'GET', 'class'=> 'pull-right']) !!}
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="s" class="form-control pull-right" value="{{ request()->get('s') }}"
                           placeholder="Поиск">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                {!! Form::close() !!}
            @endif
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center table-striped">
                @if(isset($columns))
                    <thead>
                    <tr>
                        @foreach($columns as $column)
                            <th>{{$column}}</th>
                            @if($loop->last)
                                <th></th>
                            @endif
                        @endforeach
                    </tr>
                    </thead>
                @endif
                <tbody>{{$slot}}</tbody>
            </table>
        </div>
    </div>
    @if(isset($items) && $items instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="box-footer">
            {{ $items->links() }}
        </div>
    @endif
</div>

@push('scripts')
    <script>
        $('button.btn-danger').click(function (e) {
            e.preventDefault();
            var el = $(e.currentTarget);
            var icon = el.children();
            var form = el.parent();
            icon.removeClass('fa-trash');
            icon.addClass('fa-spinner fa-pulse');
            Swal.fire({
                title: 'Вы уверены?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Да, удалить!',
                cancelButtonText: 'Отмена',
            }).then(function (result) {
                if (result.value) {
                    form.submit();
                    return;
                }
                icon.removeClass('fa-spinner fa-pulse');
                icon.addClass('fa-trash');
            });
        });
    </script>
@endpush
