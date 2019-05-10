<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $personalDataTSNote -> name, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $personalDataTSNote -> description, ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

{!! Form::hidden('content', 'Content:') !!}
{!! Form::hidden('content', $personalDataTSNote -> content, ['class' => 'form-control']) !!}

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $personalDataTSNote -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $personalDataTSNote -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $personalDataTSNote -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('personal_data_t_s_id', 'Job Topic Section Id:') !!}
{!! Form::hidden('personal_data_t_s_id', $personalDataTSNote -> personal_data_t_s_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('personalDataTopicSections.show', [$personalDataTSNote -> personal_data_t_s_id]) !!}" class="btn btn-default">Cancel</a>
</div>