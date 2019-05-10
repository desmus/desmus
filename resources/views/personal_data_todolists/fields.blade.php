<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $personalDataTodolist -> name, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
</div>

<div class="form-group col-sm-12 col-lg-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $personalDataTodolist -> description, ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('status', 'Status:') !!}
  {!! Form::select('status', $select, $personalDataTodolist -> status, ['class' => 'form-control'], array('required' => 'required', 'id' => 'status')) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('datetime', 'Datetime:') !!}
  {!! Form::datetime('datetime', $personalDataTodolist -> datetime, ['class' => 'form-control'], array('required' => 'required', 'id' => 'datetime')) !!}
</div>

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $personalDataTodolist -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $personalDataTodolist -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('personal_data_id', 'College Id:') !!}
{!! Form::hidden('personal_data_id', $personalDataTodolist -> personal_data_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('personalDatas.show', [$personalDataTodolist -> personal_data_id]) !!}" class="btn btn-default">Cancel</a>
</div>