<div class="form-group {{ $errors->has('tag_title') ? 'has-error' : '' }}">
    {{ Form::label('tag_title', 'Tag title') }}
    {{ Form::text('tag_title',$tag->tag_title,['class'=>'form-control border-input','placeholder'=>'Macbook pro']) }}
    <span class="text-danger">{{ $errors->has('tag_title') ? $errors->first('tag_title') : '' }}</span>
</div>
