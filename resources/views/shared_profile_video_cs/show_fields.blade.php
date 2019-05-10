<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $sharedProfileVideoComment->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $sharedProfileVideoComment->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $sharedProfileVideoComment->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $sharedProfileVideoComment->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('shared_profile_video_id', 'Shared Profile Video Id:') !!}
  <p>{!! $sharedProfileVideoComment->shared_profile_video_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $sharedProfileVideoComment->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $sharedProfileVideoComment->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $sharedProfileVideoComment->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $sharedProfileVideoComment->updated_at !!}</p>
</div>