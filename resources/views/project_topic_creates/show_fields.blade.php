<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $projectTopicCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $projectTopicCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $projectTopicCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('project_topic_id', 'Project Topic Id:') !!}
  <p>{!! $projectTopicCreate->project_topic_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $projectTopicCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $projectTopicCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $projectTopicCreate->updated_at !!}</p>
</div>