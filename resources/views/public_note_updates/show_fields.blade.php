<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicNoteUpdate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('actual_name', 'Actual Name:') !!}
  <p>{!! $publicNoteUpdate->actual_name !!}</p>
</div>

<div class="form-group">
  {!! Form::label('past_name', 'Past Name:') !!}
  <p>{!! $publicNoteUpdate->past_name !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicNoteUpdate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicNoteUpdate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_note_id', 'Public Note Id:') !!}
  <p>{!! $publicNoteUpdate->public_note_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicNoteUpdate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicNoteUpdate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicNoteUpdate->updated_at !!}</p>
</div>