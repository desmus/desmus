<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $projectTopicView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $projectTopicView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $projectTopicView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('project_topic_id', 'Project Topic Id:') !!}
  <p>{!! $projectTopicView->project_topic_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $projectTopicView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $projectTopicView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $projectTopicView->updated_at !!}</p>
</div>