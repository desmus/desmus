<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicAudioView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicAudioView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicAudioView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_audio_id', 'Public Audio Id:') !!}
  <p>{!! $publicAudioView->public_audio_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicAudioView->deleted_at !!}</p>
</div>

<div class="form-group">
   {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicAudioView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicAudioView->updated_at !!}</p>
</div>