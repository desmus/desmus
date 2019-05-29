<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $sharedProfileNoteCResponse->id !!}</p>
</div>

<div class="form-group" style="text-align: justify; margin-right: 20px;">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $sharedProfileNoteCResponse->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $sharedProfileNoteCResponse->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $sharedProfileNoteCResponse->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('shared_profile_note_comment_id', 'Shared Profile Note Comment Id:') !!}
  <p>{!! $sharedProfileNoteCResponse->shared_profile_note_comment_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $sharedProfileNoteCResponse->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $sharedProfileNoteCResponse->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $sharedProfileNoteCResponse->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $sharedProfileNoteCResponse->updated_at !!}</p>
</div>