<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $projectTodolistDelete->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $projectTodolistDelete->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $projectTodolistDelete->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('p_t_id', 'P T Id:') !!}
  <p>{!! $projectTodolistDelete->p_t_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $projectTodolistDelete->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $projectTodolistDelete->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $projectTodolistDelete->updated_at !!}</p>
</div>