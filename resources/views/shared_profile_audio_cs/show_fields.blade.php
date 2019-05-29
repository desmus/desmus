<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $sharedProfileAudioC->id !!}</p>
</div>

<div class="form-group" style="text-align: justify; margin-right: 20px;">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $sharedProfileAudioC->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $sharedProfileAudioC->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $sharedProfileAudioC->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('shared_profile_audio_id', 'Public Audio Id:') !!}
  <p>{!! $sharedProfileAudioC->shared_profile_audio_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $sharedProfileAudioC->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $sharedProfileAudioC->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $sharedProfileAudioC->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $sharedProfileAudioC->updated_at !!}</p>
</div>