<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicVideoCommentResponse->id !!}</p>
</div>

<div class="form-group" style="text-align: justify; margin-right: 20px;">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $publicVideoCommentResponse->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $publicVideoCommentResponse->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicVideoCommentResponse->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_video_comment_id', 'Public Video Comment Id:') !!}
  <p>{!! $publicVideoCommentResponse->public_video_comment_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicVideoCommentResponse->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicVideoCommentResponse->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicVideoCommentResponse->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicVideoCommentResponse->updated_at !!}</p>
</div>