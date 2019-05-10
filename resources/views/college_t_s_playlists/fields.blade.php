<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $collegeTSPlaylist -> name, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $collegeTSPlaylist -> description, ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $collegeTSPlaylist -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $collegeTSPlaylist -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $collegeTSPlaylist -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('c_t_s_id', 'College Topic Section Id:') !!}
{!! Form::hidden('c_t_s_id', $collegeTSPlaylist -> c_t_s_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('collegeTopicSections.show', [$collegeTSPlaylist -> c_t_s_id]) !!}" class="btn btn-default">Cancel</a>
</div>