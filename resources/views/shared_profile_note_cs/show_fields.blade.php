<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $sharedProfileNoteComment->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $sharedProfileNoteComment->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $sharedProfileNoteComment->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $sharedProfileNoteComment->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('shared_profile_note_id', 'Shared Profile Note Id:') !!}
  <p>{!! $sharedProfileNoteComment->shared_profile_note_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $sharedProfileNoteComment->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $sharedProfileNoteComment->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $sharedProfileNoteComment->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $sharedProfileNoteComment->updated_at !!}</p>
</div>