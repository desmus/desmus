<div class="form-group col-sm-12">
  {!! Form::label('permissions', 'Permissions:') !!}
  {!! Form::select('permissions', array('basic' => 'Read', 'advanced' => 'Update'), $userProjectTSToolFile[0] -> permissions, ['class' => 'form-control'], array('required' => 'required', 'id' => 'permissions')) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $userProjectTSToolFile[0] -> datetime, ['class' => 'form-control']) !!}

{!! Form::hidden('description', 'Description:') !!}
{!! Form::hidden('description', $userProjectTSToolFile[0] -> description, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $userProjectTSToolFile[0] -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $userProjectTSToolFile[0] -> user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('project_t_s_t_file_id', 'Project Id:') !!}
{!! Form::hidden('project_t_s_t_file_id', $userProjectTSToolFile[0] -> project_t_s_t_file_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userProjectTSToolFiles.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>