<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $userJobU->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $userJobU->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $userJobU->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_j_id', 'User J Id:') !!}
  <p>{!! $userJobU->user_j_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $userJobU->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $userJobU->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $userJobU->updated_at !!}</p>
</div>