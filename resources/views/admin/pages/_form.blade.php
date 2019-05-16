@php
    $categories = \App\Models\Category::with('categories')
    ->whereNull('parent_id')
    ->get()
    ->map(function ($parent) {
        return $parent->categories->count()
                    ? $parent->categories->map(function ($category) use ($parent) {
                        return [
                            'id'=> $category->id,
                            'title' => $category->title." ($parent->title)",
                            ];
                        })
                    : [
                        [
                            'id'=> $parent->id,
                            'title' => $parent->title,
                        ]
                    ];
    })
    ->flatten(1)
    ->pluck('title', 'id');
@endphp

<div class="box-header">
    <h3 class="box-title">{{ isset($page) ? 'Редактирование' : 'Создание' }} страницы</h3>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('title', 'Название') !!}
                {!! Form::text('title', isset($page) ? $page->title : null, [
                'class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''),
                'required']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{$errors->has('category_id') ? ' has-error' : ''}}">
                {!! Form::label('category_id','Категория') !!}
                {!! Form::select('category_id', $categories , isset($page) ? $page->category->id : null, [
                'class' => 'form-control select2' . ($errors->has('category_id') ? ' is-invalid' : ''),
                'placeholder' => 'Выберете категорию',
                'required',
                ]) !!}
            </div>
        </div>
        <div class="col-md-12">
            @component('admin.components.trumbowyg', [
                'name' => 'content',
                'title' => 'Содержимое',
                'options' => [
                    'class' => 'form-control',
                    'required',
                ],
            ])
            @endcomponent
    </div>
    </div>
</div>
@include('admin.shared.form_box_footer')
