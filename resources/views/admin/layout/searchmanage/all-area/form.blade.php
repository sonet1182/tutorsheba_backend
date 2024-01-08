<div class="form-group {{ $errors->has('district_id') ? 'has-error' : ''}}">
    {!! Form::label('district_id', 'District Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('district_id', $dropdown_districts, null, ['class' => 'form-control', 'placeholder' => 'Please Select District Data', 'required']) !!}
        {!! $errors->first('district_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('areaName') ? 'has-error' : ''}}">
    {!! Form::label('areaName', 'Areaname', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('areaName', null, ['class' => 'form-control', 'required']) !!}
        {!! $errors->first('areaName', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
