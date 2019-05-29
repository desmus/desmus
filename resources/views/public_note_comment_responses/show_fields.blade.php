<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicNoteCommentResponse->id !!}</p>
</div>

<div class="form-group" style="text-align: justify; margin-right: 20px;">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $publicNoteCommentResponse->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $publicNoteCommentResponse->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicNoteCommentResponse->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_note_comment_id', 'Public Note Comment Id:') !!}
  <p>{!! $publicNoteCommentResponse->public_note_comment_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicNoteCommentResponse->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicNoteCommentResponse->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicNoteCommentResponse->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicNoteCommentResponse->updated_at !!}</p>
</div>