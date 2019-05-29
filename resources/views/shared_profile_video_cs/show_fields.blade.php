<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $sharedProfileVideoC->id !!}</p>
</div>

<div class="form-group" style="text-align: justify; margin-right: 20px;">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $sharedProfileVideoC->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $sharedProfileVideoC->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $sharedProfileVideoC->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('shared_profile_video_id', 'Shared Profile Video Id:') !!}
  <p>{!! $sharedProfileVideoC->shared_profile_video_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $sharedProfileVideoC->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $sharedProfileVideoC->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $sharedProfileVideoC->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $sharedProfileVideoC->updated_at !!}</p>
</div>