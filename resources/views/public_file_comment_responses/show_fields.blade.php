<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicFileCommentResponse->id !!}</p>
</div>

<div class="form-group" style="text-align: justify; margin-right: 20px;">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $publicFileCommentResponse->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $publicFileCommentResponse->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicFileCommentResponse->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_file_comment_id', 'Public File Comment Id:') !!}
  <p>{!! $publicFileCommentResponse->public_file_comment_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicFileCommentResponse->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicFileCommentResponse->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicFileCommentResponse->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicFileCommentResponse->updated_at !!}</p>
</div>