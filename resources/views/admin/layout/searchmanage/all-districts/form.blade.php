<div class="form-group {{ $errors->has('districtName') ? 'has-error' : ''}}">
    {!! Form::label('districtName', 'Districtname', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('districtName', null, ['class' => 'form-control']) !!}
        {!! $errors->first('districtName', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>



