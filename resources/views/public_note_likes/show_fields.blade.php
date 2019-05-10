<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicNoteLike->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $publicNoteLike->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicNoteLike->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_note_id', 'Public Note Id:') !!}
  <p>{!! $publicNoteLike->public_note_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicNoteLike->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicNoteLike->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicNoteLike->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicNoteLike->updated_at !!}</p>
</div>