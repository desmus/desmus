<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicNoteComment->id !!}</p>
</div>

<div class="form-group" style="text-align: justify; margin-right: 20px;">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $publicNoteComment->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $publicNoteComment->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicNoteComment->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_note_id', 'Public Note Id:') !!}
  <p>{!! $publicNoteComment->public_note_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicNoteComment->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicNoteComment->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicNoteComment->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicNoteComment->updated_at !!}</p>
</div>