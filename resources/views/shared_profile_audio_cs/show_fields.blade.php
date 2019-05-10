<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $sharedProfileAudioComment->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $sharedProfileAudioComment->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $sharedProfileAudioComment->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $sharedProfileAudioComment->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('shared_profile_audio_id', 'Public Audio Id:') !!}
  <p>{!! $sharedProfileAudioComment->shared_profile_audio_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $sharedProfileAudioComment->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $sharedProfileAudioComment->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $sharedProfileAudioComment->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $sharedProfileAudioComment->updated_at !!}</p>
</div>