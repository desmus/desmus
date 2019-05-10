<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $jobTopicView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $jobTopicView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $jobTopicView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('job_topic_id', 'Job Topic Id:') !!}
  <p>{!! $jobTopicView->job_topic_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $jobTopicView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $jobTopicView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $jobTopicView->updated_at !!}</p>
</div>