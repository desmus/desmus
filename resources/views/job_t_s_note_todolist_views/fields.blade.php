<div class="form-group col-sm-6">
  {!! Form::label('datetime', 'Datetime:') !!}
  {!! Form::date('datetime', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('user_id', 'User Id:') !!}
  {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('j_t_s_n_t_id', 'J T S N T Id:') !!}
  {!! Form::number('j_t_s_n_t_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('jobTSNoteTodolistViews.index') !!}" class="btn btn-default">Cancel</a>
</div>