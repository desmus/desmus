<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $userJobC->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $userJobC->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $userJobC->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_j_id', 'User J Id:') !!}
  <p>{!! $userJobC->user_j_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $userJobC->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $userJobC->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $userJobC->updated_at !!}</p>
</div>