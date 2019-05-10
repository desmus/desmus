<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $projectTSToolTodolist -> name, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
</div>

<div class="form-group col-sm-12 col-lg-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $projectTSToolTodolist -> description, ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('status', 'Status:') !!}
  {!! Form::select('status', $select, $projectTSToolTodolist -> status, ['class' => 'form-control'], array('required' => 'required', 'id' => 'status')) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('datetime', 'Datetime:') !!}
  {!! Form::datetime('datetime', $projectTSToolTodolist -> datetime, ['class' => 'form-control'], array('required' => 'required', 'id' => 'datetime')) !!}
</div>

  {!! Form::hidden('views_quantity', 'Views Quantity:') !!}
  {!! Form::hidden('views_quantity', $projectTSToolTodolist -> views_quantity, ['class' => 'form-control']) !!}

  {!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
  {!! Form::hidden('updates_quantity', $projectTSToolTodolist -> updates_quantity, ['class' => 'form-control']) !!}

  {!! Form::hidden('p_t_s_t_id', 'Project Id:') !!}
  {!! Form::hidden('p_t_s_t_id', $projectTSToolTodolist -> p_t_s_t_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('projectTSTools.show', [$projectTSToolTodolist -> p_t_s_t_id]) !!}" class="btn btn-default">Cancel</a>
</div>