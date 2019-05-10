<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $jobTodolistCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $jobTodolistCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $jobTodolistCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('j_t_id', 'J T Id:') !!}
  <p>{!! $jobTodolistCreate->j_t_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $jobTodolistCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $jobTodolistCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $jobTodolistCreate->updated_at !!}</p>
</div>