<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $projectTSToolFile -> name, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $projectTSToolFile -> description, ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

{!! Form::hidden('file_type', 'File Type:') !!}
{!! Form::hidden('file_type', $projectTSToolFile -> file_type, ['class' => 'form-control']) !!}

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $projectTSToolFile -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $projectTSToolFile -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $projectTSToolFile -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('project_t_s_t_id', 'Project T S T Id:') !!}
{!! Form::hidden('project_t_s_t_id', $projectTSToolFile -> project_t_s_t_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('projectTSTools.show', $projectTSToolFile -> project_t_s_t_id) !!}" class="btn btn-default">Cancel</a>
</div>