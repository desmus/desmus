<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $projectTSGaleryTodolist -> name, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
</div>

<div class="form-group col-sm-12 col-lg-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $projectTSGaleryTodolist -> description, ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('status', 'Status:') !!}
  {!! Form::select('status', $select, $projectTSGaleryTodolist -> status, ['class' => 'form-control'], array('required' => 'required', 'id' => 'status')) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('datetime', 'Datetime:') !!}
  {!! Form::datetime('datetime', $projectTSGaleryTodolist -> datetime, ['class' => 'form-control'], array('required' => 'required', 'id' => 'datetime')) !!}
</div>

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $projectTSGaleryTodolist -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $projectTSGaleryTodolist -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('p_t_s_g_id', 'Project Id:') !!}
{!! Form::hidden('p_t_s_g_id', $projectTSGaleryTodolist -> p_t_s_g_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('projectTSGaleries.show', [$projectTSGaleryTodolist -> p_t_s_g_id]) !!}" class="btn btn-default">Cancel</a>
</div>