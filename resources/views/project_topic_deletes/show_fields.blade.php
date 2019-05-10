<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $projectTopicDelete->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $projectTopicDelete->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $projectTopicDelete->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('project_topic_id', 'Project Topic Id:') !!}
  <p>{!! $projectTopicDelete->project_topic_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $projectTopicDelete->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $projectTopicDelete->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $projectTopicDelete->updated_at !!}</p>
</div>