<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $userJobD->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $userJobD->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $userJobD->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_j_id', 'User J Id:') !!}
  <p>{!! $userJobD->user_j_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $userJobD->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $userJobD->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>!! $userJobD->updated_at !!}</p>
</div>