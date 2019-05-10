<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $collegeTodolistDelete->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $collegeTodolistDelete->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $collegeTodolistDelete->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('c_t_id', 'C T Id:') !!}
  <p>{!! $collegeTodolistDelete->c_t_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $collegeTodolistDelete->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $collegeTodolistDelete->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $collegeTodolistDelete->updated_at !!}</p>
</div>