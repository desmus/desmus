<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $personalDataTSPlaylist -> name, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $personalDataTSPlaylist -> description, ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $personalDataTSPlaylist -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $personalDataTSPlaylist -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $personalDataTSPlaylist -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('p_d_t_s_id', 'Job Topic Section Id:') !!}
{!! Form::hidden('p_d_t_s_id', $personalDataTSPlaylist -> p_d_t_s_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('personalDataTopicSections.show', [$personalDataTSPlaylist -> p_d_t_s_id]) !!}" class="btn btn-default">Cancel</a>
</div>