<div class="form-group col-sm-6">
  {!! Form::label('content', 'Content:') !!}
  {!! Form::text('content', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('status', 'Status:') !!}
  {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('datetime', 'Datetime:') !!}
  {!! Form::date('datetime', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('s_p_f_id', 'Shared Profile File Id:') !!}
  {!! Form::number('s_p_f_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('user_id', 'User Id:') !!}
  {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('sharedProfileFileComments.index') !!}" class="btn btn-default">Cancel</a>
</div>