<div class="form-group {{ $errors->has('howItWorks_title') ? 'has-error' : ''}}">
    {!! Form::label('howItWorks_title', 'How It Works Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('howItWorks_title', null, ['class' => 'form-control']) !!}
        {!! $errors->first('howItWorks_title', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('howItWorks_content') ? 'has-error' : ''}}">
    {!! Form::label('howItWorks_content', 'How It Works Content', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-12">
        {!! Form::textarea('howItWorks_content', null, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text']) !!}
        {!! $errors->first('howItWorks_content', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('howItWorks_type') ? 'has-error' : ''}}">
    {!! Form::label('howItWorks_type', 'How It Works Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('howItWorks_type', array('students' => 'Students', 'tutors' => 'Tutors'), null, ['class' => 'form-control', 'placeholder' => 'Please Select How It Works Type']) !!}
        {!! $errors->first('howItWorks_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
