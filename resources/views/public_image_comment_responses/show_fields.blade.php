<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicImageCommentResponse->id !!}</p>
</div>

<div class="form-group" style="text-align: justify; margin-right: 20px;">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $publicImageCommentResponse->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $publicImageCommentResponse->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicImageCommentResponse->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_image_comment_id', 'Public Image Comment Id:') !!}
  <p>{!! $publicImageCommentResponse->public_image_comment_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicImageCommentResponse->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicImageCommentResponse->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicImageCommentResponse->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicImageCommentResponse->updated_at !!}</p>
</div>