<div class="form-group col-sm-6">
  {!! Form::label('datetime', 'Datetime:') !!}
  {!! Form::date('datetime', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('user_id', 'User Id:') !!}
  {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('user_j_t_s_n_id', 'User J T S N Id:') !!}
  {!! Form::number('user_j_t_s_n_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
 {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userJobTSNoteDs.index') !!}" class="btn btn-default">Cancel</a>
</div>