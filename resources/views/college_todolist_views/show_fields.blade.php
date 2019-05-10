<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $collegeTodolistView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $collegeTodolistView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $collegeTodolistView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('c_t_id', 'C T Id:') !!}
  <p>{!! $collegeTodolistView->c_t_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $collegeTodolistView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $collegeTodolistView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $collegeTodolistView->updated_at !!}</p>
</div>