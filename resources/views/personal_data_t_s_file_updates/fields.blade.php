<div class="form-group col-sm-6">
  {!! Form::label('actual_name', 'Actual Name:') !!}
  {!! Form::text('actual_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('past_name', 'Past Name:') !!}
  {!! Form::text('past_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('datetime', 'Datetime:') !!}
  {!! Form::date('datetime', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('user_id', 'User Id:') !!}
  {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('personal_data_t_s_file_id', 'Personal Data T S File Id:') !!}
  {!! Form::number('personal_data_t_s_file_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('personalDataTSFileUpdates.index') !!}" class="btn btn-default">Cancel</a>
</div>