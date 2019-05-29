<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $sharedProfileImageC->id !!}</p>
</div>

<div class="form-group" style="text-align: justify; margin-right: 20px;">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $sharedProfileImageC->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $sharedProfileImageC->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $sharedProfileImageC->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('shared_profile_image_id', 'Public Image Id:') !!}
  <p>{!! $sharedProfileImageC->shared_profile_image_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $sharedProfileImageC->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $sharedProfileImageC->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $sharedProfileImageC->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $sharedProfileImageC->updated_at !!}</p>
</div>