<div class="form-group {{ $errors->has('faq_title') ? 'has-error' : ''}}">
    {!! Form::label('faq_title', 'FAQ Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('faq_title', null, ['class' => 'form-control']) !!}
        {!! $errors->first('faq_title', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('faq_content') ? 'has-error' : ''}}">
    {!! Form::label('faq_content', 'FAQ Content', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-12">
        {!! Form::textarea('faq_content', null, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text']) !!}
        {!! $errors->first('faq_content', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('faq_type') ? 'has-error' : ''}}">
    {!! Form::label('faq_type', 'FAQ Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('faq_type', array('students' => 'Students', 'teachers' => 'Teachers'), null, ['class' => 'form-control', 'placeholder' => 'Please Select Faq Type']) !!}
        {!! $errors->first('faq_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
