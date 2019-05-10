<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $jobTodolistView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $jobTodolistView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $jobTodolistView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('j_t_id', 'C T Id:') !!}
  <p>{!! $jobTodolistView->j_t_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $jobTodolistView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $jobTodolistView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $jobTodolistView->updated_at !!}</p>
</div>