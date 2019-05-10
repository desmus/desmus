<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $personalDataTSToolFile -> name, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $personalDataTSToolFile -> description, ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

{!! Form::hidden('file_type', 'File Type:') !!}
{!! Form::hidden('file_type', $personalDataTSToolFile -> file_type, ['class' => 'form-control']) !!}

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $personalDataTSToolFile -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $personalDataTSToolFile -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $personalDataTSToolFile -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('personal_data_t_s_t_id', 'Job T S T Id:') !!}
{!! Form::hidden('personal_data_t_s_t_id', $personalDataTSToolFile -> personalData_t_s_t_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('personalDataTSTools.show', $personalDataTSToolFile -> personal_data_t_s_t_id) !!}" class="btn btn-default">Cancel</a>
</div>