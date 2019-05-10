<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $collegeTSGaleryTodolist -> name, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
</div>

<div class="form-group col-sm-12 col-lg-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $collegeTSGaleryTodolist -> description, ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('status', 'Status:') !!}
  {!! Form::select('status', $select, $collegeTSGaleryTodolist -> status, ['class' => 'form-control'], array('required' => 'required', 'id' => 'status')) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('datetime', 'Datetime:') !!}
  {!! Form::datetime('datetime', $collegeTSGaleryTodolist -> datetime, ['class' => 'form-control'], array('required' => 'required', 'id' => 'datetime')) !!}
</div>

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $collegeTSGaleryTodolist -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $collegeTSGaleryTodolist -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('c_t_s_g_id', 'College Id:') !!}
{!! Form::hidden('c_t_s_g_id', $collegeTSGaleryTodolist -> c_t_s_g_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('collegeTSGaleries.show', [$collegeTSGaleryTodolist -> c_t_s_g_id]) !!}" class="btn btn-default">Cancel</a>
</div>