<div class="form-group {{$errors->has($name) ? ' has-error' : ''}}">
    {!! Form::label($name, $title) !!}
    {!! Form::textarea($name, null, $options) !!}
</div>

@push('scripts')
    <script>
        $('textarea#{{$name}}').trumbowyg({
            lang: 'ru',
        });
    </script>
@endpush
