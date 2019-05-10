<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $projectTodolistView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $projectTodolistView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $projectTodolistView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('p_t_id', 'P T Id:') !!}
  <p>{!! $projectTodolistView->p_t_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $projectTodolistView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $projectTodolistView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $projectTodolistView->updated_at !!}</p>
</div>