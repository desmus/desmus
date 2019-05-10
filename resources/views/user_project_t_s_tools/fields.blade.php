<div class="form-group col-sm-12">
  {!! Form::label('permissions', 'Permissions:') !!}
  {!! Form::select('permissions', array('basic' => 'Read', 'advanced' => 'Update'), $userProjectTSTool[0] -> permissions, ['class' => 'form-control']) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $userProjectTSTool[0] -> datetime, ['class' => 'form-control']) !!}

{!! Form::hidden('description', 'Description:') !!}
{!! Form::hidden('description', $userProjectTSTool[0] -> description, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $userProjectTSTool[0] -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $userProjectTSTool[0] -> user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('project_t_s_tool_id', 'Project Id:') !!}
{!! Form::hidden('project_t_s_tool_id', $userProjectTSTool[0] -> project_t_s_tool_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userProjectTSTools.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>