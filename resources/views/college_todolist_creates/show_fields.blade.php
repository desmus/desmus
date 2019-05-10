<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $collegeTodolistCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $collegeTodolistCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $collegeTodolistCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('c_t_id', 'C T Id:') !!}
  <p>{!! $collegeTodolistCreate->c_t_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $collegeTodolistCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $collegeTodolistCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $collegeTodolistCreate->updated_at !!}</p>
</div>