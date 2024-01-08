<div class="form-group {{ $errors->has('university') ? 'has-error' : ''}}">
    {!! Form::label('university', 'University', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('university', null, ['class' => 'form-control']) !!}
        {!! $errors->first('university', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
