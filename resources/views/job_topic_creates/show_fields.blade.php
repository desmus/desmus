<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $jobTopicCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $jobTopicCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $jobTopicCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('job_topic_id', 'Job Topic Id:') !!}
  <p>{!! $jobTopicCreate->job_topic_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $jobTopicCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $jobTopicCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $jobTopicCreate->updated_at !!}</p>
</div>