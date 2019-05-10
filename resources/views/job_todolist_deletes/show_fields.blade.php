<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $jobTodolistDelete->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $jobTodolistDelete->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $jobTodolistDelete->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('j_t_id', 'J T Id:') !!}
  <p>{!! $jobTodolistDelete->j_t_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $jobTodolistDelete->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $jobTodolistDelete->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $jobTodolistDelete->updated_at !!}</p>
</div>