<div class="form-group col-sm-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', 'Add a description ...', ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('user_id', 'User:') !!}
  {!! Form::select('user_id', $select, null, ['class'=>'form-control'], array('required' => 'required', 'id' => 'user_id')) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}

{!! Form::hidden('permissions', 'Permissions:') !!}
{!! Form::hidden('permissions', 'basic', ['class' => 'form-control']) !!}

{!! Form::hidden('job_t_s_t_file_id', 'Job Topic Section Tool File Id:') !!}
{!! Form::hidden('job_t_s_t_file_id', $id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userJobTSToolFiles.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>