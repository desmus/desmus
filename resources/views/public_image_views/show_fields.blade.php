<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicImageView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicImageView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicImageView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_image_id', 'Public Image Id:') !!}
  <p>{!! $publicImageView->public_image_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicImageView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicImageView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicImageView->updated_at !!}</p>
</div>