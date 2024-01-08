<div class="form-group {{ $errors->has('class_id') ? 'has-error' : ''}}">
    {!! Form::label('class_id', 'Class ID', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('class_id', $dropdown_class, null, ['class' => 'form-control', 'placeholder' => 'Please Select Class Data']) !!}
        {!! $errors->first('class_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('subjectName') ? 'has-error' : ''}}">
    {!! Form::label('subjectName', 'Subjectname', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('subjectName', null, ['class' => 'form-control']) !!}
        {!! $errors->first('subjectName', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>