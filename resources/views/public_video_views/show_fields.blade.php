<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicVideoView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicVideoView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicVideoView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_video_id', 'Public Video Id:') !!}
  <p>{!! $publicVideoView->public_video_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicVideoView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicVideoView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicVideoView->updated_at !!}</p>
</div>