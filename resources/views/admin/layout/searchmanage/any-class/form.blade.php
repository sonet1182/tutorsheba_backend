<div class="form-group {{ $errors->has('medium_id') ? 'has-error' : ''}}">
    {!! Form::label('medium_id', 'Medium ID', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('medium_id', $dropdown, null, ['class' => 'form-control', 'placeholder' => 'Please Select Medium Data']) !!}
        {!! $errors->first('medium_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('className') ? 'has-error' : ''}}">
    {!! Form::label('className', 'Classname', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('className', null, ['class' => 'form-control']) !!}
        {!! $errors->first('className', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
