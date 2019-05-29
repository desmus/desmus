<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicAudioCommentResponse->id !!}</p>
</div>

<div class="form-group" style="text-align: justify; margin-right: 20px;">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $publicAudioCommentResponse->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $publicAudioCommentResponse->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicAudioCommentResponse->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_audio_comment_id', 'Public Audio Comment Id:') !!}
  <p>{!! $publicAudioCommentResponse->public_audio_comment_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicAudioCommentResponse->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicAudioCommentResponse->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicAudioCommentResponse->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicAudioCommentResponse->updated_at !!}</p>
</div>