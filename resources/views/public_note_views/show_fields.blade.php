<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicNoteView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicNoteView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicNoteView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_note_id', 'Public Note Id:') !!}
  <p>{!! $publicNoteView->public_note_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicNoteView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicNoteView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicNoteView->updated_at !!}</p>
</div>