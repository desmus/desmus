<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $jobTopicDelete->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $jobTopicDelete->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $jobTopicDelete->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('job_topic_id', 'Job Topic Id:') !!}
  <p>{!! $jobTopicDelete->job_topic_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $jobTopicDelete->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $jobTopicDelete->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $jobTopicDelete->updated_at !!}</p>
</div>