<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $collegeTopicTodolist -> name, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
</div>

<div class="form-group col-sm-12 col-lg-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $collegeTopicTodolist -> description, ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('status', 'Status:') !!}
  {!! Form::select('status', $select, $collegeTopicTodolist -> status, ['class' => 'form-control'], array('required' => 'required', 'id' => 'status')) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('datetime', 'Datetime:') !!}
  {!! Form::datetime('datetime', $collegeTopicTodolist -> datetime, ['class' => 'form-control'], array('required' => 'required', 'id' => 'datetime')) !!}
</div>

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $collegeTopicTodolist -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $collegeTopicTodolist -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('college_topic_id', 'College Id:') !!}
{!! Form::hidden('college_topic_id', $collegeTopicTodolist -> college_topic_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('collegeTopics.show', [$collegeTopicTodolist -> college_topic_id]) !!}" class="btn btn-default">Cancel</a>
</div>